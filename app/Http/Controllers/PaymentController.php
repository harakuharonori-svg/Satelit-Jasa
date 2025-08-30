<?php
namespace App\Http\Controllers;
use App\Models\Jasa;
use App\Models\Transaksi;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class PaymentController extends Controller
{
    protected $xenditService;
    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
    }
    public function processPayment(Request $request)
    {
        try {
            \Log::info('Payment request received', $request->all());
            $request->validate([
                'jasa_id' => 'required|exists:jasas,id',
                'payment_method' => 'required|in:qris,bca,bni,bri,cimb,invoice',
                'deadline' => 'required|in:7,30,90',
            ]);
            \Log::info('Validation passed');
            DB::beginTransaction();
            $user = Auth::user();
            $jasa = Jasa::findOrFail($request->jasa_id);
            $basePrice = $jasa->harga;
            $deadlineDays = $request->deadline;
            $multiplier = match($deadlineDays) {
                7 => 1.5,
                30 => 1.2,
                90 => 1.0,
                default => 1.0
            };
            $totalAmount = $basePrice * $multiplier;
            $deadlineDate = now()->addDays($deadlineDays);
            \Log::info('Creating transaction', [
                'user_id' => $user->id,
                'jasa_id' => $jasa->id,
                'total' => $totalAmount,
                'deadline' => $deadlineDate
            ]);
            $transaksi = Transaksi::create([
                'id_user' => $user->id,
                'id_jasa' => $jasa->id,
                'total' => $totalAmount,
                'status' => 'Belum',
                'deadline' => $deadlineDate,
            ]);
            \Log::info('Transaction created successfully', ['transaksi_id' => $transaksi->id]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'data' => [
                    'transaksi_id' => $transaksi->id,
                    'total' => $totalAmount,
                    'deadline' => $deadlineDate->format('Y-m-d H:i:s'),
                    'status' => 'Transaksi dibuat, menunggu pembayaran'
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error creating payment: ' . $e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function verifyAndUpdatePayment(Request $request)
    {
        try {
            $request->validate([
                'external_id' => 'required|string'
            ]);
            $transaksi = Transaksi::where('external_id', $request->external_id)->first();
            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }
            if ($transaksi->payment_status === 'paid') {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran sudah dikonfirmasi sebelumnya',
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'status' => 'paid',
                        'already_paid' => true
                    ]
                ]);
            }
            try {
                $xenditStatus = $this->xenditService->checkPaymentStatus($transaksi->external_id);
                if ($xenditStatus['success'] && isset($xenditStatus['status'])) {
                    if (strtolower($xenditStatus['status']) === 'paid' || strtolower($xenditStatus['status']) === 'settled') {
                        $updateData = [
                            'payment_status' => 'paid',
                            'paid_at' => now(),
                            'payment_data' => json_encode($xenditStatus),
                            'escrow_status' => 'held',
                            'project_status' => 'in_progress'
                        ];
                        $transaksi->update($updateData);
                        $transaksi->updateEarnings();
                        if ($store = $transaksi->store()) {
                            $store->updatePendingBalance();
                        }
                        return response()->json([
                            'success' => true,
                            'message' => 'Pembayaran berhasil dikonfirmasi dan escrow diaktifkan',
                            'data' => [
                                'external_id' => $transaksi->external_id,
                                'status' => 'paid',
                                'escrow_status' => 'held',
                                'project_status' => 'in_progress',
                                'verified_at' => now()->toISOString(),
                                'xendit_status' => $xenditStatus['status'],
                                'updated' => true,
                                'freelancer_earnings' => $transaksi->freelancer_earnings,
                                'platform_fee' => $transaksi->platform_fee
                            ]
                        ]);
                    } else {
                        return response()->json([
                            'success' => true,
                            'message' => 'Pembayaran belum dikonfirmasi',
                            'data' => [
                                'external_id' => $transaksi->external_id,
                                'status' => $xenditStatus['status'],
                                'verified_at' => now()->toISOString(),
                                'updated' => false
                            ]
                        ]);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal mengecek status pembayaran dari Xendit',
                        'error' => $xenditStatus['message'] ?? 'Unknown error'
                    ], 400);
                }
            } catch (\Exception $xenditError) {
                \Log::error('Xendit verification error', [
                    'external_id' => $transaksi->external_id,
                    'error' => $xenditError->getMessage()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal terhubung ke Xendit API: ' . $xenditError->getMessage()
                ], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment verification error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat verifikasi pembayaran'
            ], 500);
        }
    }
    private function createPayment($transaksi, $jasa, $paymentMethod)
    {
        $user = Auth::user();
        try {
            switch ($paymentMethod) {
                case 'qris':
                    return $this->createQRISPayment($transaksi, $jasa, $user);
                case 'bca':
                case 'bni':
                case 'bri':
                case 'cimb':
                    return $this->createVirtualAccountPayment($transaksi, $jasa, $user, strtoupper($paymentMethod));
                case 'invoice':
                    return $this->createInvoicePayment($transaksi, $jasa, $user);
                default:
                    return ['success' => false, 'message' => 'Metode pembayaran tidak didukung'];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Error creating payment: ' . $e->getMessage()
            ];
        }
    }
    private function createQRISPayment($transaksi, $jasa, $user)
    {
        $result = $this->xenditService->createQRIS([
            'external_id' => $transaksi->external_id,
            'amount' => $transaksi->total,
        ]);
        if ($result['success']) {
            return [
                'success' => true,
                'data' => [
                    'external_id' => $result['data']['external_id'],
                    'qr_string' => $result['qr_string'],
                    'amount' => $transaksi->total,
                    'created_at' => now()->toISOString()
                ],
                'qr_string' => $result['qr_string'],
                'payment_reference' => $result['qr_string'],
            ];
        }
        return $result;
    }
    private function createVirtualAccountPayment($transaksi, $jasa, $user, $bankCode)
    {
        $result = $this->xenditService->createVirtualAccount([
            'external_id' => $transaksi->external_id,
            'bank_code' => $bankCode,
            'name' => $user->nama,
            'amount' => $transaksi->total,
        ]);
        if ($result['success']) {
            return [
                'success' => true,
                'data' => $result['data'],
                'account_number' => $result['account_number'],
                'bank_code' => $result['bank_code'],
                'payment_reference' => $result['account_number'],
            ];
        }
        return $result;
    }
    private function createInvoicePayment($transaksi, $jasa, $user)
    {
        $result = $this->xenditService->createInvoice([
            'external_id' => $transaksi->external_id,
            'payer_email' => $user->email,
            'description' => 'Pembayaran Jasa: ' . $jasa->judul,
            'amount' => $transaksi->total,
            'customer' => [
                'given_names' => $user->nama,
                'email' => $user->email,
            ],
            'payment_methods' => ['BANK_TRANSFER', 'CREDIT_CARD', 'EWALLET', 'QR_CODE'],
            'customer_notification_preference' => [
                'invoice_created' => ['email'],
                'invoice_reminder' => ['email'],
                'invoice_paid' => ['email'],
                'invoice_expired' => ['email'],
            ]
        ]);
        if ($result['success']) {
            return [
                'success' => true,
                'data' => $result['data'],
                'invoice_url' => $result['invoice_url'],
                'payment_reference' => $result['external_id'],
            ];
        }
        return $result;
    }
    private function getDeadlineMultiplier($days)
    {
        switch ($days) {
            case 7:
                return 1.5; // +50%
            case 30:
                return 1.0; // Normal
            case 90:
                return 0.5; // -50%
            default:
                return 1.0;
        }
    }
    public function paymentSuccess(Request $request)
    {
        $externalId = $request->get('external_id');
        if ($externalId) {
            $transaksi = Transaksi::with(['jasa', 'user'])->where('external_id', $externalId)->first();
            if ($transaksi) {
                return view('payment.success', compact('transaksi'));
            }
        }
        return view('payment.success', ['transaksi' => null]);
    }
    public function paymentFailed(Request $request)
    {
        $externalId = $request->get('external_id');
        if ($externalId) {
            $transaksi = Transaksi::where('external_id', $externalId)->first();
            if ($transaksi) {
                return view('payment.failed', compact('transaksi'));
            }
        }
        return view('payment.failed');
    }
    public function checkPaymentStatus($externalId)
    {
        $transaksi = Transaksi::where('external_id', $externalId)->first();
        if (!$transaksi) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }
        $result = $this->xenditService->getInvoice($externalId);
        if ($result['success']) {
            $invoiceData = $result['data'];
            if ($invoiceData['status'] === 'PAID' && $transaksi->payment_status !== 'paid') {
                $transaksi->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'data' => [
                'external_id' => $transaksi->external_id,
                'payment_status' => $transaksi->payment_status,
                'total_amount' => $transaksi->total,
                'is_expired' => $transaksi->isExpired(),
                'is_paid' => $transaksi->isPaid(),
            ]
        ]);
    }
    private function createMockPayment($transaksi, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'qris':
                $mockQRString = 'https://qris.dev/mock/' . $transaksi->external_id;
                return [
                    'success' => true,
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'qr_string' => $mockQRString,
                        'amount' => $transaksi->total,
                        'created_at' => now()->toISOString(),
                        'mock' => true
                    ],
                    'qr_string' => $mockQRString,
                    'payment_reference' => $mockQRString,
                ];
            case 'bca':
            case 'bni':
            case 'bri':
            case 'cimb':
                $mockVA = '8017' . rand(100000000000, 999999999999);
                return [
                    'success' => true,
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'account_number' => $mockVA,
                        'bank_code' => strtoupper($paymentMethod),
                        'mock' => true
                    ],
                    'account_number' => $mockVA,
                    'bank_code' => strtoupper($paymentMethod),
                    'payment_reference' => $mockVA,
                ];
            default:
                return [
                    'success' => true,
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'mock' => true
                    ],
                    'invoice_url' => route('payment.success') . '?external_id=' . $transaksi->external_id,
                    'payment_reference' => $transaksi->external_id,
                ];
        }
    }
    public function simulatePayment(Request $request)
    {
        if (!in_array(config('app.env'), ['local', 'development'])) {
            return response()->json([
                'success' => false,
                'message' => 'Payment simulation only available in development environment'
            ], 403);
        }
        try {
            $request->validate([
                'external_id' => 'required|string',
                'status' => 'required|in:paid,failed,expired',
            ]);
            $transaksi = Transaksi::where('external_id', $request->external_id)->first();
            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }
            $transaksi->payment_status = $request->status;
            switch ($request->status) {
                case 'paid':
                    $transaksi->paid_at = Carbon::now();
                    break;
                case 'failed':
                    if (Schema::hasColumn('transaksis', 'failed_at')) {
                        $transaksi->failed_at = Carbon::now();
                    }
                    break;
                case 'expired':
                    $transaksi->expired_at = Carbon::now();
                    break;
            }
            $transaksi->save();
            \Log::info('Payment simulated', [
                'external_id' => $request->external_id,
                'new_status' => $request->status,
                'user' => Auth::user()->id ?? 'guest'
            ]);
            return response()->json([
                'success' => true,
                'message' => "Payment status berhasil disimulasikan menjadi: {$request->status}",
                'data' => [
                    'external_id' => $transaksi->external_id,
                    'status' => $transaksi->payment_status,
                    'updated_at' => $transaksi->updated_at
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment simulation error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function verifyPayment(Request $request)
    {
        try {
            $request->validate([
                'external_id' => 'required|string',
                'verification_status' => 'required|in:verified,rejected',
                'verification_notes' => 'nullable|string|max:500',
            ]);
            $transaksi = Transaksi::where('external_id', $request->external_id)->first();
            if (!$transaksi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }
            if ($transaksi->payment_status !== 'paid') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya pembayaran dengan status paid yang bisa diverifikasi'
                ], 400);
            }
            if (Schema::hasColumn('transaksis', 'verification_status')) {
                $transaksi->verification_status = $request->verification_status;
            }
            if (Schema::hasColumn('transaksis', 'verification_notes')) {
                $transaksi->verification_notes = $request->verification_notes;
            }
            if (Schema::hasColumn('transaksis', 'verified_at')) {
                $transaksi->verified_at = $request->verification_status === 'verified' ? Carbon::now() : null;
            }
            if (Schema::hasColumn('transaksis', 'verified_by')) {
                $transaksi->verified_by = Auth::user()->id;
            }
            $transaksi->save();
            \Log::info('Payment verified', [
                'external_id' => $request->external_id,
                'verification_status' => $request->verification_status,
                'verified_by' => Auth::user()->id,
                'notes' => $request->verification_notes
            ]);
            return response()->json([
                'success' => true,
                'message' => "Pembayaran berhasil {$request->verification_status}",
                'data' => [
                    'external_id' => $transaksi->external_id,
                    'verification_status' => $transaksi->verification_status,
                    'verified_at' => $transaksi->verified_at,
                    'verified_by' => $transaksi->verified_by
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Payment verification error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function checkRealPaymentStatus(Request $request)
    {
        try {
            \Log::info('Check payment status request', $request->all());
            $request->validate([
                'external_id' => 'required|string',
            ]);
            $transaksi = Transaksi::where('external_id', $request->external_id)->first();
            if (!$transaksi) {
                \Log::warning('Transaction not found for external_id: ' . $request->external_id);
                return response()->json([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }
            \Log::info('Transaction found', ['id' => $transaksi->id, 'status' => $transaksi->payment_status]);
            if (config('app.env') === 'local' || config('app.env') === 'development') {
                try {
                    $xenditStatus = $this->xenditService->checkPaymentStatus($transaksi->external_id);
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'external_id' => $transaksi->external_id,
                            'local_status' => $transaksi->payment_status,
                            'xendit_status' => $xenditStatus['status'] ?? 'unknown',
                            'xendit_data' => $xenditStatus,
                            'last_updated' => $transaksi->updated_at->format('Y-m-d H:i:s')
                        ]
                    ]);
                } catch (\Exception $xenditError) {
                    \Log::info('Xendit API failed, returning mock data', ['error' => $xenditError->getMessage()]);
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'external_id' => $transaksi->external_id,
                            'local_status' => $transaksi->payment_status,
                            'xendit_status' => 'not_found',
                            'xendit_error' => 'Xendit API tidak tersedia (development mode)',
                            'last_updated' => $transaksi->updated_at->format('Y-m-d H:i:s'),
                            'note' => 'Data mock untuk development - Xendit API tidak tersedia',
                            'mock_data' => true
                        ]
                    ]);
                }
            }
            try {
                $xenditStatus = $this->xenditService->checkPaymentStatus($transaksi->external_id);
                return response()->json([
                    'success' => true,
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'local_status' => $transaksi->payment_status,
                        'xendit_status' => $xenditStatus['status'] ?? 'unknown',
                        'xendit_data' => $xenditStatus,
                        'last_updated' => $transaksi->updated_at->format('Y-m-d H:i:s')
                    ]
                ]);
            } catch (\Exception $xenditError) {
                \Log::error('Xendit API error in production', ['error' => $xenditError->getMessage()]);
                return response()->json([
                    'success' => true,
                    'data' => [
                        'external_id' => $transaksi->external_id,
                        'local_status' => $transaksi->payment_status,
                        'xendit_status' => 'api_error',
                        'xendit_error' => $xenditError->getMessage(),
                        'last_updated' => $transaksi->updated_at->format('Y-m-d H:i:s'),
                        'note' => 'Xendit API tidak tersedia, menampilkan status lokal'
                    ]
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in checkRealPaymentStatus', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment status check error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
