<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penarikan Dana - Admin - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Modal backdrop */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.15s linear;
        }
        .modal-backdrop.fade {
            opacity: 0;
        }
        .modal-backdrop.show {
            opacity: 1;
        }
        /* Modal styling */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
        }
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }
        .modal.show {
            display: block !important;
        }
        .modal.show .modal-dialog {
            transform: none;
        }
        .modal-dialog {
            position: relative;
            width: auto;
            margin: 0.5rem;
            pointer-events: none;
            margin-top: 1.75rem;
            margin-left: auto;
            margin-right: auto;
            max-width: 500px;
        }
        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            outline: 0;
        }
        /* Body scroll lock */
        .modal-open {
            overflow: hidden;
        }
        /* Responsive */
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 500px;
                margin: 1.75rem auto;
            }
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container-fluid py-4" style="margin-top: 80px;">
        <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1">Detail Penarikan Dana #{{ $withdrawal->id }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.withdrawals.index') }}">Kelola Penarikan</a></li>
                            <li class="breadcrumb-item active">Detail #{{ $withdrawal->id }}</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Penarikan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <div>
                                        @switch($withdrawal->status)
                                            @case('pending')
                                                <span class="badge bg-warning fs-6">Pending</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success fs-6">Completed</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger fs-6">Rejected</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-secondary fs-6">Cancelled</span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Pengajuan</label>
                                    <div>{{ $withdrawal->requested_at->format('d F Y, H:i') }} WIB</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Jumlah Penarikan</label>
                                    <div class="fs-5 text-primary fw-bold">
                                        Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Admin Fee (2.5%)</label>
                                    <div class="fs-6 text-warning">
                                        Rp {{ number_format($withdrawal->admin_fee, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Jumlah Diterima</label>
                                    <div class="fs-5 text-success fw-bold">
                                        Rp {{ number_format($withdrawal->net_amount, 0, ',', '.') }}
                                    </div>
                                </div>
                                @if($withdrawal->processed_at)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Tanggal Diproses</label>
                                    <div>{{ $withdrawal->processed_at->format('d F Y, H:i') }} WIB</div>
                                </div>
                                @endif
                            </div>
                            @if($withdrawal->notes)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Catatan Freelancer</label>
                                <div class="p-3 bg-light rounded">{{ $withdrawal->notes }}</div>
                            </div>
                            @endif
                            @if($withdrawal->admin_notes)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Catatan Admin</label>
                                <div class="p-3 bg-info bg-opacity-10 rounded">{{ $withdrawal->admin_notes }}</div>
                            </div>
                            @endif
                            @if($withdrawal->status == 'pending')
                            <div class="mt-4">
                                <button type="button" class="btn btn-success me-2" onclick="openApproveModal()">
                                    <i class="fas fa-check"></i> Setujui Penarikan
                                </button>
                                <button type="button" class="btn btn-danger" onclick="openRejectModal()">
                                    <i class="fas fa-times"></i> Tolak Penarikan
                                </button>
                            </div>
                            @else
                            <div class="mt-4">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> 
                                    Penarikan ini sudah diproses dengan status: <strong>{{ ucfirst($withdrawal->status) }}</strong>
                                    @if($withdrawal->processed_at)
                                        pada {{ $withdrawal->processed_at->format('d F Y, H:i') }} WIB
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card shadow mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Rekening Bank</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Nama Bank</label>
                                    <div>{{ $withdrawal->bank_name }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Nomor Rekening</label>
                                    <div class="font-monospace">{{ $withdrawal->bank_account_number }}</div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Atas Nama</label>
                                    <div>{{ $withdrawal->bank_account_name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Freelancer</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama</label>
                                <div>{{ $withdrawal->user->nama }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <div>{{ $withdrawal->user->email }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Toko</label>
                                <div>{{ $withdrawal->store->nama_store }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Total Penghasilan</label>
                                <div class="text-success fw-bold">
                                    Rp {{ number_format($totalEarnings, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Total Penarikan Selesai</label>
                                <div class="text-danger">
                                    Rp {{ number_format($completedWithdrawals, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Saldo Tersisa</label>
                                <div class="text-primary fw-bold">
                                    Rp {{ number_format($totalEarnings - $completedWithdrawals, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h5 class="mb-0">Riwayat Penarikan Lainnya</h5>
                        </div>
                        <div class="card-body">
                            @if($withdrawalHistory->count() > 0)
                                @foreach($withdrawalHistory as $history)
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <div>
                                        <small class="text-muted">#{{ $history->id }}</small>
                                        <div class="fw-bold">Rp {{ number_format($history->amount, 0, ',', '.') }}</div>
                                        <small class="text-muted">{{ $history->requested_at->format('d/m/Y') }}</small>
                                    </div>
                                    <div>
                                        @switch($history->status)
                                            @case('pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success">Completed</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-secondary">Cancelled</span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">Tidak ada riwayat penarikan lainnya.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($withdrawal->status == 'pending')
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setujui Penarikan #{{ $withdrawal->id }}</h5>
                <button type="button" class="btn-close" onclick="closeModal('approveModal')" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        Pastikan Anda telah melakukan transfer ke rekening yang tertera!
                    </div>
                    <div class="mb-3">
                        <strong>Jumlah Transfer:</strong> Rp {{ number_format($withdrawal->net_amount, 0, ',', '.') }}
                    </div>
                    <div class="mb-3">
                        <strong>Rekening Tujuan:</strong><br>
                        {{ $withdrawal->bank_name }}<br>
                        {{ $withdrawal->bank_account_number }}<br>
                        a.n. {{ $withdrawal->bank_account_name }}
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Catatan Admin (Opsional)</label>
                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="3" 
                                  placeholder="Catatan untuk freelancer..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('approveModal')">Batal</button>
                    <button type="submit" class="btn btn-success">Konfirmasi Penarikan Selesai</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Penarikan #{{ $withdrawal->id }}</h5>
                <button type="button" class="btn-close" onclick="closeModal('rejectModal')" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Jelaskan alasan penolakan dengan detail kepada freelancer.
                    </div>
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" 
                                  placeholder="Jelaskan alasan penolakan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal')">Batal</button>
                    <button type="submit" class="btn btn-danger">Konfirmasi Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous" 
        onload="console.log('Bootstrap JS loaded successfully')" 
        onerror="console.log('Bootstrap JS failed to load')"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin withdrawal detail page loaded');
    console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
    if (typeof bootstrap !== 'undefined') {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
        console.log('Bootstrap dropdowns initialized:', dropdownList.length);
    }
    window.openApproveModal = function() {
        console.log('Opening approve modal');
        openModal('approveModal');
    };
    window.openRejectModal = function() {
        console.log('Opening reject modal');
        openModal('rejectModal');
    };
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
            modal.classList.add('show');
            modal.classList.add('fade');
            document.body.classList.add('modal-open');
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'backdrop_' + modalId;
            backdrop.onclick = function() {
                closeModal(modalId);
            };
            document.body.appendChild(backdrop);
            const firstInput = modal.querySelector('input, textarea');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 300);
            }
            console.log('Modal opened successfully:', modalId);
        } else {
            console.error('Modal not found:', modalId);
        }
    }
    window.closeModal = function(modalId) {
        console.log('Closing modal:', modalId);
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
            const backdrop = document.getElementById('backdrop_' + modalId);
            if (backdrop) {
                backdrop.remove();
            }
            const allBackdrops = document.querySelectorAll('.modal-backdrop');
            allBackdrops.forEach(bd => bd.remove());
            console.log('Modal closed successfully:', modalId);
        }
    };
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
    console.log('Modal handlers initialized');
});
</script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('success') }}');
    });
</script>
@endif
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{{ session('error') }}');
    });
</script>
@endif
</body>
</html>
