<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\ProjectDelivery;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class EscrowController extends Controller
{
    public function deliverProject(Request $request)
    {
        try {
            $request->validate([
                'transaksi_id' => 'required|exists:transaksis,id',
                'delivery_message' => 'required|string|max:1000',
                'delivery_files.*' => 'nullable|file|max:10240', // 10MB max per file
                'delivery_type' => 'required|in:file,link,text,mixed'
            ]);
            $transaksi = Transaksi::findOrFail($request->transaksi_id);
            $user = Auth::user();
            if (!$transaksi->jasa || $transaksi->jasa->store->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengirim proyek ini'
                ], 403);
            }
            if (!$transaksi->canBeDelivered()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyek tidak dapat dikirim pada saat ini'
                ], 400);
            }
            DB::beginTransaction();
            $uploadedFiles = [];
            if ($request->hasFile('delivery_files')) {
                foreach ($request->file('delivery_files') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('deliveries', $fileName, 'public');
                    $uploadedFiles[] = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $filePath,
                        'size' => $file->getSize(),
                        'type' => $file->getClientMimeType()
                    ];
                }
            }
            $delivery = ProjectDelivery::create([
                'transaksi_id' => $transaksi->id,
                'delivered_by' => $user->id,
                'delivery_message' => $request->delivery_message,
                'delivery_files' => $uploadedFiles,
                'delivery_type' => $request->delivery_type,
                'status' => 'delivered',
                'delivered_at' => now(),
                'file_metadata' => [
                    'total_files' => count($uploadedFiles),
                    'total_size' => array_sum(array_column($uploadedFiles, 'size'))
                ]
            ]);
            $transaksi->update([
                'project_status' => 'delivered',
                'delivered_at' => now(),
                'delivery_notes' => $request->delivery_message
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proyek berhasil dikirim ke customer',
                'data' => [
                    'delivery_id' => $delivery->id,
                    'transaksi_id' => $transaksi->id,
                    'delivered_at' => $delivery->delivered_at->toISOString(),
                    'files_count' => count($uploadedFiles),
                    'auto_release_date' => $transaksi->delivered_at->addDays($transaksi->auto_release_days ?? 7)->toISOString()
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function approveDelivery(Request $request)
    {
        try {
            $request->validate([
                'transaksi_id' => 'required|exists:transaksis,id',
                'delivery_id' => 'required|exists:project_deliveries,id',
                'customer_rating' => 'nullable|integer|min:1|max:5',
                'customer_feedback' => 'nullable|string|max:500'
            ]);
            $transaksi = Transaksi::findOrFail($request->transaksi_id);
            $delivery = ProjectDelivery::findOrFail($request->delivery_id);
            $user = Auth::user();
            if ($transaksi->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menyetujui proyek ini'
                ], 403);
            }
            if (!$transaksi->canBeApproved()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Proyek tidak dapat disetujui pada saat ini'
                ], 400);
            }
            DB::beginTransaction();
            $delivery->update([
                'status' => 'approved',
                'customer_rating' => $request->customer_rating,
                'customer_feedback' => $request->customer_feedback,
                'responded_at' => now()
            ]);
            $transaksi->releaseEscrow($user->id, $request->customer_feedback);
            if ($request->customer_rating && $store = $transaksi->store()) {
                $store->updateRating($request->customer_rating);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Proyek disetujui dan pembayaran telah dirilis ke freelancer',
                'data' => [
                    'transaksi_id' => $transaksi->id,
                    'approved_at' => $transaksi->approved_at->toISOString(),
                    'released_amount' => $transaksi->freelancer_earnings,
                    'rating_given' => $request->customer_rating ?? null
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function requestRevision(Request $request)
    {
        try {
            $request->validate([
                'transaksi_id' => 'required|exists:transaksis,id',
                'delivery_id' => 'required|exists:project_deliveries,id',
                'revision_notes' => 'required|string|max:500'
            ]);
            $transaksi = Transaksi::findOrFail($request->transaksi_id);
            $delivery = ProjectDelivery::findOrFail($request->delivery_id);
            $user = Auth::user();
            if ($transaksi->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk meminta revisi proyek ini'
                ], 403);
            }
            DB::beginTransaction();
            $delivery->update([
                'status' => 'revision_requested',
                'requires_revision' => true,
                'revision_notes' => $request->revision_notes,
                'responded_at' => now()
            ]);
            $transaksi->update([
                'project_status' => 'in_progress'
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Permintaan revisi berhasil dikirim ke freelancer',
                'data' => [
                    'delivery_id' => $delivery->id,
                    'revision_notes' => $request->revision_notes,
                    'requested_at' => now()->toISOString()
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function autoReleaseEscrow()
    {
        try {
            $overdueTransaksis = Transaksi::where('escrow_status', 'held')
                ->where('project_status', 'delivered')
                ->whereNotNull('delivered_at')
                ->where('delivered_at', '<=', now()->subDays(7)) // Default 7 days
                ->get();
            $releasedCount = 0;
            $releasedAmount = 0;
            foreach ($overdueTransaksis as $transaksi) {
                if ($transaksi->shouldAutoRelease()) {
                    $transaksi->releaseEscrow(null, 'Auto-released after ' . $transaksi->auto_release_days . ' days');
                    $releasedCount++;
                    $releasedAmount += $transaksi->freelancer_earnings;
                }
            }
            return response()->json([
                'success' => true,
                'message' => "Auto-released {$releasedCount} transactions",
                'data' => [
                    'released_count' => $releasedCount,
                    'total_amount' => $releasedAmount
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error in auto-release: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getDashboardData(Request $request)
    {
        try {
            $user = Auth::user();
            $store = $user->store;
            if (!$store) {
                return response()->json([
                    'success' => false,
                    'message' => 'Store tidak ditemukan'
                ], 404);
            }
            $store->updatePendingBalance();
            $data = [
                'store_metrics' => $store->getPerformanceMetrics(),
                'pending_transactions' => $store->pendingTransaksis()->with(['jasa', 'user'])->latest()->take(10)->get(),
                'recent_deliveries' => ProjectDelivery::whereHas('transaksi', function($q) use ($store) {
                    $q->whereHas('jasa', function($q2) use ($store) {
                        $q2->where('id_store', $store->id);
                    });
                })->with(['transaksi.jasa', 'transaksi.user'])->latest()->take(5)->get(),
                'completed_this_month' => $store->completedTransaksis()
                    ->whereMonth('released_at', now()->month)
                    ->count(),
                'earnings_this_month' => $store->completedTransaksis()
                    ->whereMonth('released_at', now()->month)
                    ->sum('freelancer_earnings')
            ];
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function getProjectReviewData(Request $request)
    {
        try {
            $request->validate([
                'transaksi_id' => 'required|exists:transaksis,id',
                'delivery_id' => 'required|exists:project_deliveries,id'
            ]);
            $transaksi = Transaksi::with(['jasa.store.user', 'user'])->findOrFail($request->transaksi_id);
            $delivery = ProjectDelivery::findOrFail($request->delivery_id);
            $user = Auth::user();
            if ($transaksi->id_user !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk melihat proyek ini'
                ], 403);
            }
            if ($delivery->transaksi_id !== $transaksi->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data delivery tidak valid'
                ], 400);
            }
            $revisionHistory = ProjectDelivery::where('transaksi_id', $transaksi->id)
                ->where('id', '<>', $delivery->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $data = [
                'transaksi' => [
                    'id' => $transaksi->id,
                    'jasa' => [
                        'nama_jasa' => $transaksi->jasa->nama_jasa,
                        'deskripsi' => $transaksi->jasa->deskripsi_jasa
                    ],
                    'store' => [
                        'nama_toko' => $transaksi->jasa->store->nama_toko,
                        'user' => [
                            'name' => $transaksi->jasa->store->user->name
                        ]
                    ],
                    'total' => $transaksi->total,
                    'project_status' => $transaksi->project_status,
                    'escrow_status' => $transaksi->escrow_status,
                    'created_at' => $transaksi->created_at->toISOString(),
                    'paid_at' => $transaksi->paid_at ? $transaksi->paid_at->toISOString() : null,
                    'delivered_at' => $transaksi->delivered_at ? $transaksi->delivered_at->toISOString() : null,
                    'auto_release_days' => $transaksi->auto_release_days ?? 7,
                    'freelancer_earnings' => $transaksi->freelancer_earnings
                ],
                'delivery' => [
                    'id' => $delivery->id,
                    'delivery_message' => $delivery->delivery_message,
                    'delivery_type' => $delivery->delivery_type,
                    'delivery_files' => $delivery->delivery_files ?? [],
                    'delivered_at' => $delivery->delivered_at->toISOString(),
                    'status' => $delivery->status,
                    'customer_rating' => $delivery->customer_rating,
                    'customer_feedback' => $delivery->customer_feedback,
                    'revision_notes' => $delivery->revision_notes
                ],
                'revision_history' => $revisionHistory->map(function($rev) {
                    return [
                        'id' => $rev->id,
                        'delivery_message' => $rev->delivery_message,
                        'status' => $rev->status,
                        'delivered_at' => $rev->delivered_at->toISOString(),
                        'revision_notes' => $rev->revision_notes,
                        'customer_feedback' => $rev->customer_feedback
                    ];
                })
            ];
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
