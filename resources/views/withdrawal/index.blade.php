<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penarikan Dana - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
        :root {
            --primary-black: #000000;
            --primary-white: #ffffff;
            --soft-gray: #f8f9fa;
            --border-gray: #e0e0e0;
            --text-gray: #6c757d;
            --success-green: #28a745;
            --danger-red: #dc3545;
            --warning-yellow: #ffc107;
            --shadow-light: 0 2px 10px rgba(0,0,0,0.1);
            --shadow-hover: 0 5px 25px rgba(0,0,0,0.15);
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--primary-black);
            background: var(--soft-gray);
        }
        .withdrawal-page {
            padding-top: 120px;
            min-height: 100vh;
        }
        .page-header {
            background: linear-gradient(135deg, var(--primary-black) 0%, #333 100%);
            color: var(--primary-white);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .section-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        .withdrawal-card {
            background: var(--primary-white);
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        .withdrawal-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }
        .balance-info {
            background: linear-gradient(135deg, var(--success-green) 0%, #20c997 100%);
            color: var(--primary-white);
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            text-align: center;
        }
        .balance-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .balance-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
            color: var(--primary-black);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-control {
            border: 2px solid var(--border-gray);
            border-radius: 12px;
            padding: 0.875rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--primary-white);
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary-black);
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
        }
        .form-control::placeholder {
            color: var(--text-gray);
            opacity: 0.7;
        }
        .withdrawal-btn {
            background: var(--primary-black);
            border: 2px solid var(--primary-black);
            color: var(--primary-white);
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }
        .withdrawal-btn:hover {
            background: transparent;
            color: var(--primary-black);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }
        .withdrawal-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        .history-section {
            margin-top: 3rem;
        }
        .history-card {
            background: var(--primary-white);
            border: none;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .history-card:hover {
            box-shadow: var(--shadow-hover);
            transform: translateY(-2px);
        }
        .history-item {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-gray);
        }
        .history-item:last-child {
            border-bottom: none;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: var(--warning-yellow);
            border: 1px solid var(--warning-yellow);
        }
        .status-completed {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-green);
            border: 1px solid var(--success-green);
        }
        .status-cancelled {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-red);
            border: 1px solid var(--danger-red);
        }
        .cancel-btn {
            background: transparent;
            border: 2px solid var(--danger-red);
            color: var(--danger-red);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .cancel-btn:hover {
            background: var(--danger-red);
            color: var(--primary-white);
        }
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--text-gray);
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        .empty-state h4 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-black);
        }
        .amount-input-group {
            position: relative;
        }
        .amount-prefix {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            font-weight: 600;
            z-index: 2;
        }
        .amount-input {
            padding-left: 3rem;
        }
        .fee-info {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid var(--warning-yellow);
            color: #856404;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-green);
            border: 1px solid var(--success-green);
        }
        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-red);
            border: 1px solid var(--danger-red);
        }
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        .page-link {
            color: var(--primary-black);
            border: 2px solid var(--border-gray);
            margin: 0 0.25rem;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .page-link:hover {
            background: var(--primary-black);
            color: var(--primary-white);
            border-color: var(--primary-black);
        }
        .page-item.active .page-link {
            background: var(--primary-black);
            border-color: var(--primary-black);
        }
        @media (max-width: 768px) {
            .withdrawal-page {
                padding-top: 100px;
            }
            .page-header {
                padding: 2rem 0;
            }
            .section-title {
                font-size: 2rem;
            }
            .withdrawal-card {
                padding: 1.5rem;
            }
            .balance-amount {
                font-size: 2rem;
            }
        }
</style>
<body>
    <x-navbar />
    <div class="withdrawal-page">
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="section-title">
                            <i class="fas fa-money-bill-wave me-3"></i>
                            Penarikan Dana
                        </h1>
                        <p class="section-subtitle">
                            Tarik penghasilan Anda dengan mudah dan aman
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="withdrawal-card">
                        <div class="balance-info">
                            <div class="balance-amount">Rp {{ number_format($availableBalance, 0, ',', '.') }}</div>
                            <div class="balance-label">Saldo Tersedia untuk Ditarik</div>
                        </div>
                        @if($availableBalance > 0)
                            <form action="{{ route('withdrawal.store') }}" method="POST" id="withdrawalForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-university"></i>
                                                Nama Bank
                                            </label>
                                            <select class="form-control" name="bank_name" required>
                                                <option value="">Pilih Bank</option>
                                                <option value="BCA">Bank Central Asia (BCA)</option>
                                                <option value="BNI">Bank Negara Indonesia (BNI)</option>
                                                <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                                                <option value="Mandiri">Bank Mandiri</option>
                                                <option value="CIMB">CIMB Niaga</option>
                                                <option value="Danamon">Bank Danamon</option>
                                                <option value="Permata">Bank Permata</option>
                                                <option value="OCBC">OCBC NISP</option>
                                                <option value="Maybank">Maybank</option>
                                                <option value="BSI">Bank Syariah Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-credit-card"></i>
                                                Nomor Rekening
                                            </label>
                                            <input type="text" class="form-control" name="bank_account_number" 
                                                   placeholder="Contoh: 1234567890" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i>
                                        Nama Pemilik Rekening
                                    </label>
                                    <input type="text" class="form-control" name="bank_account_name" 
                                           placeholder="Nama sesuai rekening bank" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Jumlah Penarikan
                                    </label>
                                    <div class="amount-input-group">
                                        <span class="amount-prefix">Rp</span>
                                        <input type="number" class="form-control amount-input" name="amount" 
                                               placeholder="Minimal Rp 50.000" 
                                               min="50000" 
                                               max="{{ $availableBalance }}"
                                               id="amountInput" required>
                                    </div>
                                    <div class="fee-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Biaya admin 2.5%</strong> dari jumlah penarikan. 
                                        <span id="feeCalculation"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-sticky-note"></i>
                                        Catatan (Opsional)
                                    </label>
                                    <textarea class="form-control" name="notes" rows="3" 
                                              placeholder="Catatan tambahan untuk penarikan ini"></textarea>
                                </div>
                                <button type="submit" class="withdrawal-btn" id="submitBtn">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Ajukan Penarikan
                                </button>
                            </form>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-wallet"></i>
                                <h4>Saldo Tidak Tersedia</h4>
                                <p>Anda belum memiliki saldo yang dapat ditarik.<br>
                                   Selesaikan proyek untuk mendapatkan penghasilan.</p>
                                <a href="{{ route('freelancer.orders.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-tasks me-2"></i>
                                    Lihat Pesanan
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="withdrawal-card">
                        <h5 class="mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Informasi Penarikan
                        </h5>
                        <div class="mb-3">
                            <strong>Minimum Penarikan:</strong><br>
                            Rp 50.000
                        </div>
                        <div class="mb-3">
                            <strong>Biaya Admin:</strong><br>
                            2.5% dari jumlah penarikan
                        </div>
                        <div class="mb-3">
                            <strong>Waktu Proses:</strong><br>
                            1-3 hari kerja
                        </div>
                        <div class="mb-3">
                            <strong>Jam Operasional:</strong><br>
                            Senin - Jumat: 09:00 - 17:00 WIB
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <small>Pastikan data rekening yang Anda masukkan sudah benar. Kesalahan data rekening bukan tanggung jawab kami.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="history-section">
                <h3 class="mb-4">
                    <i class="fas fa-history me-2"></i>
                    Riwayat Penarikan
                </h3>
                @if($withdrawalHistory->count() > 0)
                    @foreach($withdrawalHistory as $withdrawal)
                        <div class="history-card">
                            <div class="history-item">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <div class="fw-bold">{{ $withdrawal->bank_name }}</div>
                                        <small class="text-muted">{{ $withdrawal->bank_account_number }}</small>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="fw-bold">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</div>
                                        <small class="text-muted">Diterima: Rp {{ number_format($withdrawal->net_amount, 0, ',', '.') }}</small>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="status-badge status-{{ $withdrawal->status }}">
                                            @if($withdrawal->status === 'pending')
                                                <i class="fas fa-clock"></i> Menunggu
                                            @elseif($withdrawal->status === 'completed')
                                                <i class="fas fa-check"></i> Selesai
                                            @else
                                                <i class="fas fa-times"></i> Dibatalkan
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-md-2">
                                        <small class="text-muted">{{ $withdrawal->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <div class="col-md-2 text-end">
                                        @if($withdrawal->status === 'pending')
                                            <form action="{{ route('withdrawal.cancel', $withdrawal->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="cancel-btn" 
                                                        onclick="return confirm('Yakin ingin membatalkan penarikan ini?')">
                                                    <i class="fas fa-times me-1"></i>
                                                    Batal
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if($withdrawalHistory->hasPages())
                        <div class="pagination-wrapper">
                            {{ $withdrawalHistory->links() }}
                        </div>
                    @endif
                @else
                    <div class="history-card">
                        <div class="empty-state">
                            <i class="fas fa-file-alt"></i>
                            <h4>Belum Ada Riwayat</h4>
                            <p>Anda belum pernah melakukan penarikan dana.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        document.getElementById('amountInput').addEventListener('input', function() {
            const amount = parseFloat(this.value) || 0;
            const adminFee = amount * 0.025;
            const netAmount = amount - adminFee;
            const feeCalculation = document.getElementById('feeCalculation');
            if (amount > 0) {
                feeCalculation.innerHTML = `Biaya admin: Rp ${adminFee.toLocaleString('id-ID')} | Yang diterima: Rp ${netAmount.toLocaleString('id-ID')}`;
            } else {
                feeCalculation.innerHTML = '';
            }
        });
        document.getElementById('withdrawalForm').addEventListener('submit', function(e) {
            const amount = parseFloat(document.getElementById('amountInput').value);
            const maxAmount = {{ $availableBalance }};
            if (amount > maxAmount) {
                e.preventDefault();
                alert('Jumlah penarikan melebihi saldo yang tersedia!');
                return false;
            }
            if (amount < 50000) {
                e.preventDefault();
                alert('Minimum penarikan adalah Rp 50.000!');
                return false;
            }
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        });
    </script>
</body>
</html>
