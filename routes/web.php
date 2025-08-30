<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\inbox;
use App\Http\Controllers\KategoriJasaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfilPageController;
use App\Http\Controllers\DetailJasaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\XenditWebhookController;
use App\Http\Controllers\LamanJasaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TambahKategoriController;
use App\Http\Controllers\BuatTokoController;
use App\Http\Controllers\BuatJasaController;
use App\Http\Controllers\EditJasaController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\EscrowController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Jasa;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Public Routes
Route::get("/", [LandingPageController::class, "index"]);
Route::get('/detail/{id}', [DetailJasaController::class, "show"])->name('jasa.detail');
Route::get('/lamanjasa', [LamanJasaController::class, "index"]);
Route::get('/categories', [KategoriJasaController::class, "index"]);

// Store Routes (Public Access)
Route::get('/toko/{id}', [TokoController::class, "show"])->name('toko.show');

// Xendit Webhook (Public, no authentication required)
Route::post('/webhook/xendit', [XenditWebhookController::class, 'handleWebhook'])->name('xendit.webhook');

// Payment Success/Failed Pages (Public)
Route::get('/payment/success', function() {
    $externalId = request()->get('external_id');
    $transaksi = null;
    
    if ($externalId && preg_match('/TXN-(\d+)-\d+/', $externalId, $matches)) {
        $transaksiId = $matches[1];
        $transaksi = Transaksi::with(['jasa', 'user'])->find($transaksiId);
        
        // Add virtual payment_status field based on database status
        if ($transaksi) {
            $transaksi->payment_status = $transaksi->status === 'Selesai' ? 'paid' : 'pending';
            $transaksi->external_id = $externalId;
        }
    }
    
    return view('payment.success', ['transaksi' => $transaksi]);
})->name('payment.success');
Route::get('/payment/failed', function() {
    return view('payment.failed');
})->name('payment.failed');

// Guest Routes (only for non-authenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [AuthController::class, "index"])->name('login');
    Route::post('/auth/login', [AuthController::class, "login"])->name("login.post");
    Route::get('/auth/register', [AuthController::class, "register"])->name('register');
    Route::post('/auth/register', [AuthController::class, "store"])->name("register.store");
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile & User Management
    Route::get("/profil/", [ProfilPageController::class, "index"]);
    Route::post('/auth/logout', [AuthController::class, "logout"])->name("logout");
    
    // Store Management (Blocked for Admin)
    Route::middleware(['no.admin'])->group(function () {
        Route::get('/buattoko', [BuatTokoController::class, "index"]);
        Route::post('/buattoko', [BuatTokoController::class, "store"])->name("toko.store");
        Route::get('/toko', [TokoController::class, "index"])->name('toko.index'); // Redirect ke toko sendiri
        
        // Service Management
        Route::get('/tambahjasa', [BuatJasaController::class, "index"]);
        Route::post('/tambahjasa', [BuatJasaController::class, "store"])->name("jasa.store");
        
        // Edit Jasa
        Route::get('/editjasa/{id}', [EditJasaController::class, "index"])->name('jasa.edit');
        Route::put('/editjasa/{id}', [EditJasaController::class, "update"])->name('jasa.update');
        Route::delete('/editjasa/banner/{id}', [EditJasaController::class, "deleteBanner"])->name('jasa.banner.delete');
    });
    
    // Communication
    Route::get('/chat/{storeId?}', [ChatController::class, "chat"])->name('chat');
    Route::post('/chat/{roomId}/send', [ChatController::class, "sendMessage"])->name('chat.send');
    Route::get('/inbox', [inbox::class, "index"]);
    Route::get('/mail/', [inbox::class, "mail"]);
    
    // Test Route
    Route::get('/test-payment', function() {
        return response()->json(['message' => 'Payment test route working', 'time' => now()]);
    });
    
    // Test Database
    Route::get('/test-db', function() {
        try {
            $user = Auth::user();
            $jasaCount = Jasa::count();
            $transaksiCount = Transaksi::count();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user_authenticated' => $user ? true : false,
                    'user_id' => $user ? $user->id : null,
                    'jasa_count' => $jasaCount,
                    'transaksi_count' => $transaksiCount
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    });
    
    // Payment Routes
    Route::get("/detail/pembayaran/{jasa_id}", [PembayaranController::class, "index"])->name('pembayaran');
    Route::post('/payment/process', function(Request $request) {
        try {
            \Log::info('Payment request received', $request->all());
            
            // Simple validation
            if (!$request->has('jasa_id')) {
                return response()->json(['success' => false, 'message' => 'jasa_id required'], 422);
            }
            if (!$request->has('deadline')) {
                return response()->json(['success' => false, 'message' => 'deadline required'], 422);
            }
            if (!$request->has('payment_method')) {
                return response()->json(['success' => false, 'message' => 'payment_method required'], 422);
            }

            \Log::info('Basic validation passed');

            // Get authenticated user
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }
            
            \Log::info('User authenticated', ['user_id' => $user->id]);

            // Get jasa
            $jasa = Jasa::find($request->jasa_id);
            if (!$jasa) {
                return response()->json(['success' => false, 'message' => 'Jasa not found'], 404);
            }
            
            \Log::info('Jasa found', ['jasa_id' => $jasa->id, 'price' => $jasa->harga]);

            // Calculate amount
            $basePrice = $jasa->harga;
            $deadlineDays = (int) $request->deadline;
            
            $multiplier = match($deadlineDays) {
                7 => 1.5,
                30 => 1.2,
                90 => 1.0,
                default => 1.0
            };
            
            $totalAmount = $basePrice * $multiplier;
            $deadlineDate = now()->addDays($deadlineDays);
            
            \Log::info('Amount calculated', [
                'base_price' => $basePrice,
                'multiplier' => $multiplier,
                'total' => $totalAmount,
                'deadline' => $deadlineDate
            ]);

            // Start transaction
            DB::beginTransaction();
            
            // Generate Virtual Account number berdasarkan payment method
            $paymentMethod = $request->payment_method;
            $vaNumber = null;
            
            if (in_array($paymentMethod, ['bca', 'bni', 'bri', 'cimb'])) {
                // Generate VA number format: BANKCODE + USER_ID + RANDOM
                $bankCode = match($paymentMethod) {
                    'bca' => '014',
                    'bni' => '009', 
                    'bri' => '002',
                    'cimb' => '022',
                    default => '000'
                };
                
                // Generate 12 digit VA: BANKCODE(3) + USER_ID(3) + RANDOM(6)
                $userPart = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                $randomPart = str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                $vaNumber = $bankCode . $userPart . $randomPart;
                
                \Log::info('Generated VA number', [
                    'payment_method' => $paymentMethod,
                    'bank_code' => $bankCode,
                    'user_part' => $userPart,
                    'random_part' => $randomPart,
                    'va_number' => $vaNumber
                ]);
            }
            
            // Create transaction record
            $transaksi = new Transaksi();
            $transaksi->id_user = $user->id;
            $transaksi->id_jasa = $jasa->id;
            $transaksi->total = $totalAmount;
            $transaksi->status = 'Belum';
            $transaksi->deadline = $deadlineDate;
            $transaksi->payment_method = $paymentMethod;
            $transaksi->payment_reference = $vaNumber; // VA number
            $transaksi->payment_status = 'pending'; // Initial payment status
            $transaksi->save();
            
            // Generate external_id after getting transaksi ID
            $externalId = 'TXN-' . $transaksi->id . '-' . time();
            $transaksi->external_id = $externalId;
            $transaksi->save();

            \Log::info('Transaction created', ['transaksi_id' => $transaksi->id]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'data' => [
                    'transaksi_id' => $transaksi->id,
                    'external_id' => $externalId,
                    'total' => $totalAmount,
                    'deadline' => $deadlineDate->format('Y-m-d H:i:s'),
                    'payment_method' => $paymentMethod,
                    'payment_reference' => $vaNumber,
                    'payment_status' => 'pending',
                    'status' => 'Transaksi dibuat, menunggu pembayaran'
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Payment processing error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    })->name('payment.process');
    
    // Test route for debugging
    Route::get('/payment/test', function() {
        return response()->json(['message' => 'Payment test route working', 'user' => auth()->user()]);
    });
    
    // Payment simulation route
    Route::post('/payment/simulate', function(Request $request) {
        try {
            \Log::info('Payment simulation requested', $request->all());
            
            $externalId = $request->external_id;
            $status = $request->status ?? 'paid';
            
            if (!$externalId) {
                return response()->json([
                    'success' => false,
                    'message' => 'External ID is required'
                ], 422);
            }
            
            // Extract transaction ID from external_id format: TXN-{id}-{timestamp}
            if (preg_match('/TXN-(\d+)-\d+/', $externalId, $matches)) {
                $transaksiId = $matches[1];
                $transaksi = Transaksi::find($transaksiId);
                
                if ($transaksi) {
                    // Update transaction status based on simulation
                    switch ($status) {
                        case 'paid':
                            $transaksi->status = 'Selesai';
                            break;
                        case 'failed':
                        case 'expired':
                        default:
                            $transaksi->status = 'Belum';
                    }
                    
                    $transaksi->save();
                    
                    \Log::info('Transaction status updated via simulation', [
                        'transaksi_id' => $transaksi->id,
                        'new_status' => $transaksi->status,
                        'simulation_type' => $status
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Payment simulated successfully',
                        'data' => [
                            'status' => $transaksi->status,
                            'external_id' => $externalId,
                            'payment_status' => $transaksi->status === 'Selesai' ? 'PAID' : 'PENDING',
                            'simulation' => true,
                            'simulation_type' => $status
                        ]
                    ]);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
            
        } catch (\Exception $e) {
            \Log::error('Payment simulation error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Simulation failed: ' . $e->getMessage()
            ], 500);
        }
    })->name('payment.simulate');
    
    // Payment status check route
    Route::post('/payment/check-status', function(Request $request) {
        try {
            \Log::info('Payment status check requested', $request->all());
            
            $externalId = $request->external_id;
            if (!$externalId) {
                return response()->json([
                    'success' => false,
                    'message' => 'External ID is required'
                ], 422);
            }
            
            // Extract transaction ID from external_id format: TXN-{id}-{timestamp}
            if (preg_match('/TXN-(\d+)-\d+/', $externalId, $matches)) {
                $transaksiId = $matches[1];
                $transaksi = Transaksi::find($transaksiId);
                
                if ($transaksi) {
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'status' => $transaksi->status,
                            'external_id' => $externalId,
                            'payment_status' => $transaksi->status === 'Selesai' ? 'PAID' : 'PENDING',
                            'total' => $transaksi->total,
                            'created_at' => $transaksi->created_at->format('Y-m-d H:i:s')
                        ]
                    ]);
                }
            }
            
            // Default response for unknown external_id
            return response()->json([
                'success' => true,
                'data' => [
                    'status' => 'PENDING',
                    'external_id' => $externalId,
                    'payment_status' => 'PENDING',
                    'message' => 'Transaction is being processed'
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Payment status check error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Status check failed: ' . $e->getMessage()
            ], 500);
        }
    })->name('payment.check-status');
    
    // Payment verify and update route - Hit Xendit API
    Route::post('/payment/verify-update', function(Request $request) {
        try {
            \Log::info('Payment verify-update requested', $request->all());
            
            $externalId = $request->external_id;
            if (!$externalId) {
                return response()->json([
                    'success' => false,
                    'message' => 'External ID is required'
                ], 422);
            }
            
            // Extract transaction ID from external_id format: TXN-{id}-{timestamp}
            if (preg_match('/TXN-(\d+)-\d+/', $externalId, $matches)) {
                $transaksiId = $matches[1];
                $transaksi = Transaksi::find($transaksiId);
                
                if (!$transaksi) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Transaction not found'
                    ], 404);
                }
                
                // TODO: Hit Xendit API to check payment status
                // For now, simulate checking Xendit API
                $xenditApiKey = config('services.xendit.secret_key', 'xnd_development_test');
                
                // Simulate Xendit API call (replace with actual Xendit API call)
                $xenditStatus = 'PENDING'; // Default status
                
                // In real implementation, you would call:
                // $xenditResponse = Http::withHeaders([
                //     'Authorization' => 'Basic ' . base64_encode($xenditApiKey . ':'),
                // ])->get("https://api.xendit.co/v2/invoices/{$externalId}");
                
                // Check Cache untuk simulasi payment (Development only)
                $simulationExists = \Cache::get('xendit_simulation_' . $externalId);
                if ($simulationExists) {
                    $xenditStatus = $simulationExists;
                    \Log::info('Found simulation status', ['external_id' => $externalId, 'status' => $xenditStatus]);
                } else {
                    // DEFAULT: Payment belum dibayar (PENDING)
                    // Jangan auto-PAID! User harus bayar dulu atau simulasi dulu
                    $xenditStatus = 'PENDING';
                    \Log::info('No simulation found, payment status is PENDING', ['external_id' => $externalId]);
                }
                
                // Update database if payment is confirmed
                $oldStatus = $transaksi->status;
                
                \Log::info('Xendit status check', [
                    'external_id' => $externalId,
                    'xendit_status' => $xenditStatus,
                    'simulation_exists' => $simulationExists ? true : false,
                    'old_status' => $oldStatus,
                    'transaksi_id' => $transaksi->id
                ]);
                
                if ($xenditStatus === 'PAID') {
                    $transaksi->status = 'Selesai'; // Use correct ENUM value
                    $transaksi->payment_status = 'paid';
                    $transaksi->paid_at = now();
                    $transaksi->save();
                    \Log::info('Transaction updated to Selesai via Xendit verification', [
                        'transaksi_id' => $transaksi->id,
                        'old_status' => $oldStatus,
                        'new_status' => $transaksi->status,
                        'payment_status' => $transaksi->payment_status
                    ]);
                } elseif ($xenditStatus === 'FAILED') {
                    $transaksi->status = 'Belum'; // Keep as Belum for failed
                    $transaksi->payment_status = 'failed';
                    $transaksi->save();
                } elseif ($xenditStatus === 'EXPIRED') {
                    $transaksi->status = 'Belum'; // Keep as Belum for expired
                    $transaksi->payment_status = 'expired';
                    $transaksi->save();
                } else {
                    // PENDING - no database update needed, just keep current status
                    \Log::info('Payment status is PENDING, no database update needed', [
                        'transaksi_id' => $transaksi->id,
                        'xendit_status' => $xenditStatus
                    ]);
                }
                
                // Map status to payment status dan response message
                $paymentStatus = 'PENDING';
                $responseMessage = 'Payment verification completed';
                
                if ($transaksi->status === 'Selesai') {
                    $paymentStatus = 'PAID';
                    $responseMessage = 'Pembayaran berhasil dikonfirmasi!';
                } else {
                    $paymentStatus = 'PENDING';
                    if ($xenditStatus === 'PENDING') {
                        $responseMessage = 'Pembayaran belum diterima. Silakan lakukan pembayaran terlebih dahulu.';
                    } elseif ($xenditStatus === 'FAILED') {
                        $responseMessage = 'Pembayaran gagal. Silakan coba lagi.';
                    } elseif ($xenditStatus === 'EXPIRED') {
                        $responseMessage = 'Pembayaran telah kedaluwarsa. Silakan buat transaksi baru.';
                    }
                }
                
                return response()->json([
                    'success' => $paymentStatus === 'PAID',
                    'message' => $responseMessage,
                    'data' => [
                        'external_id' => $externalId,
                        'xendit_status' => $xenditStatus,
                        'old_status' => $oldStatus,
                        'current_status' => $transaksi->status,
                        'payment_status' => $paymentStatus,
                        'updated_at' => $transaksi->updated_at->format('Y-m-d H:i:s'),
                        'database_updated' => $oldStatus !== $transaksi->status
                    ]
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Invalid external ID format'
            ], 400);
            
        } catch (\Exception $e) {
            \Log::error('Payment verify-update error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Verification failed: ' . $e->getMessage()
            ], 500);
        }
    })->name('payment.verify-update');
    
    // Xendit simulation route (dev only)
    Route::post('/payment/xendit-simulate', function(Request $request) {
        try {
            // Only allow in development
            if (!in_array(config('app.env'), ['local', 'development'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Simulation only available in development'
                ], 403);
            }
            
            \Log::info('Xendit simulation requested', $request->all());
            
            $externalId = $request->external_id;
            $status = $request->status ?? 'PAID';
            
            if (!$externalId) {
                return response()->json([
                    'success' => false,
                    'message' => 'External ID is required'
                ], 422);
            }
            
            // Simulate storing Xendit payment status in cache
            // In real scenario, this would be done by Xendit's system
            \Cache::put('xendit_simulation_' . $externalId, $status, now()->addHours(24));
            
            \Log::info('Xendit payment simulated', [
                'external_id' => $externalId,
                'simulated_status' => $status
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Xendit payment simulation completed',
                'data' => [
                    'external_id' => $externalId,
                    'simulated_status' => $status,
                    'note' => 'This simulation affects what verify-update will find when checking Xendit API'
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Xendit simulation error', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Xendit simulation failed: ' . $e->getMessage()
            ], 500);
        }
    })->name('payment.xendit-simulate');
    
    // Escrow Management Routes
    Route::prefix('escrow')->name('escrow.')->group(function () {
        Route::post('/deliver', [EscrowController::class, 'deliverProject'])->name('deliver');
        Route::post('/approve', [EscrowController::class, 'approveDelivery'])->name('approve');
        Route::post('/revision', [EscrowController::class, 'requestRevision'])->name('revision');
        Route::get('/dashboard', [EscrowController::class, 'getDashboardData'])->name('dashboard');
        Route::get('/review', function () {
            return view('escrow.review');
        })->name('review.view');
        Route::get('/project-review-data', [EscrowController::class, 'getProjectReviewData'])->name('project.review.data');
        
        // Admin only route for auto-release
        Route::middleware(['admin'])->group(function () {
            Route::post('/auto-release', [EscrowController::class, 'autoReleaseEscrow'])->name('auto-release');
        });
    });
    
    // Category Management (Admin/User)
    Route::get('/kategori', [KategoriController::class, "index"]);
    Route::delete('/kategori/{id}', [KategoriController::class, "delete"])->name("kategori.delete");
    Route::get('/kategori/edit/{id}', [KategoriController::class, "edit"]);
    Route::patch('/kategori/edit/{id}', [KategoriController::class, "update"])->name("kategori.update");
    Route::get('/kategori/tambah', [TambahKategoriController::class, "index"]);
    Route::post('/kategori/tambah', [TambahKategoriController::class, "store"])->name("kategori.store");
    
    // Order Management Routes
    // Client Orders (for regular users)
    Route::prefix('my-orders')->name('orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\OrderController::class, 'show'])->name('show');
        Route::get('/{id}/download', [\App\Http\Controllers\OrderController::class, 'downloadFile'])->name('download');
        Route::post('/{id}/request-refund', [\App\Http\Controllers\OrderController::class, 'requestRefund'])->name('request-refund');
        Route::post('/{id}/confirm-delivery', [\App\Http\Controllers\OrderController::class, 'confirmDelivery'])->name('confirm-delivery');
    });
    
    // Freelancer Orders (for store owners)
    Route::prefix('freelancer-orders')->name('freelancer.orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\FreelancerOrderController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\FreelancerOrderController::class, 'show'])->name('show');
        Route::post('/{id}/accept', [\App\Http\Controllers\FreelancerOrderController::class, 'accept'])->name('accept');
        Route::post('/{id}/reject', [\App\Http\Controllers\FreelancerOrderController::class, 'reject'])->name('reject');
        Route::post('/{id}/start', [\App\Http\Controllers\FreelancerOrderController::class, 'start'])->name('start');
        Route::post('/{id}/complete', [\App\Http\Controllers\FreelancerOrderController::class, 'complete'])->name('complete');
        Route::post('/{id}/upload-file', [\App\Http\Controllers\FreelancerOrderController::class, 'uploadFile'])->name('upload-file');
    });
    
    // Freelancer Withdrawal Routes (for earnings)
    Route::prefix('withdrawal')->name('withdrawal.')->group(function () {
        Route::get('/', [WithdrawalController::class, 'index'])->name('index');
        Route::post('/request', [WithdrawalController::class, 'store'])->name('store');
        Route::post('/{id}/cancel', [WithdrawalController::class, 'cancel'])->name('cancel');
    });
    
    // Client Withdrawal Routes (for refunds)
    Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
        Route::get('/', [\App\Http\Controllers\ClientWithdrawalController::class, 'index'])->name('index');
        Route::get('/create/{transaksi}', [\App\Http\Controllers\ClientWithdrawalController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\ClientWithdrawalController::class, 'store'])->name('store');
    });
    
    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        // Admin Withdrawal Management
        Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'reject'])->name('reject');
            Route::get('/export/csv', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'export'])->name('export');
            
            // Test route untuk debug approve
            Route::get('/{id}/test-approve', function($id) {
                $withdrawal = \App\Models\Withdrawal::findOrFail($id);
                
                if ($withdrawal->status !== 'pending') {
                    return response()->json(['error' => 'Withdrawal not pending, current status: ' . $withdrawal->status]);
                }

                $withdrawal->update([
                    'status' => 'completed',
                    'processed_at' => now(),
                    'processed_by' => \Illuminate\Support\Facades\Auth::id(),
                    'admin_notes' => 'Test approval'
                ]);

                return response()->json(['success' => 'Withdrawal approved successfully', 'withdrawal' => $withdrawal]);
            })->name('test-approve');
        });
    });
});