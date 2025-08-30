<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penarikan Dana - Admin - SatelitJasa</title>
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
        /* Animation */
        .modal.fade {
            transition: opacity 0.15s linear;
        }
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
        }
    </style>
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        .border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }
        .border-left-info {
            border-left: 0.25rem solid #36b9cc !important;
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
                    <h2 class="mb-1">Kelola Penarikan Dana</h2>
                    <p class="text-muted mb-0">Kelola permintaan penarikan dana freelancer</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Menunggu Persetujuan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_pending'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Selesai
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_completed'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Ditolak
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_rejected'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Pending
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp {{ number_format($stats['total_amount_pending'], 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-rupiah-sign fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.withdrawals.index') }}">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="search" class="form-label">Cari</label>
                                <input type="text" name="search" id="search" class="form-control" 
                                       placeholder="Nama freelancer, email, rekening..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="date_from" class="form-label">Dari Tanggal</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" 
                                       value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="date_to" class="form-label">Sampai Tanggal</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" 
                                       value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.withdrawals.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penarikan Dana</h6>
                </div>
                <div class="card-body">
                    @if($withdrawals->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Freelancer</th>
                                        <th>Jumlah</th>
                                        <th>Admin Fee</th>
                                        <th>Bank</th>
                                        <th>Status</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">#{{ $withdrawal->id }}</span>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $withdrawal->user->nama }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $withdrawal->store->nama_store }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</strong>
                                                <br>
                                                <small class="text-success">
                                                    Net: Rp {{ number_format($withdrawal->net_amount, 0, ',', '.') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-warning">
                                                Rp {{ number_format($withdrawal->admin_fee, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $withdrawal->bank_name }}</strong>
                                                <br>
                                                <small>{{ $withdrawal->bank_account_number }}</small>
                                                <br>
                                                <small class="text-muted">{{ $withdrawal->bank_account_name }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @switch($withdrawal->status)
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
                                        </td>
                                        <td>
                                            <small>{{ $withdrawal->requested_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.withdrawals.show', $withdrawal->id) }}" 
                                                   class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($withdrawal->status == 'pending')
                                                    <form method="POST" action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" 
                                                          style="display: inline;" 
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menyetujui penarikan ini?\n\nJumlah: Rp {{ number_format($withdrawal->amount, 0, ",", ".") }}\nFreelancer: {{ $withdrawal->user->nama }}')">
                                                        @csrf
                                                        <input type="hidden" name="admin_notes" value="Quick approval from admin dashboard">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Setujui Penarikan">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="openRejectModal({{ $withdrawal->id }})"
                                                            title="Tolak Penarikan">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="rejectModal{{ $withdrawal->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Penarikan #{{ $withdrawal->id }}</h5>
                                                    <button type="button" class="btn-close" onclick="closeModal('rejectModal{{ $withdrawal->id }}')" aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Mengapa Anda menolak penarikan ini?</p>
                                                        <div class="mb-3">
                                                            <label for="admin_notes_{{ $withdrawal->id }}" class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                                                            <textarea name="admin_notes" id="admin_notes_{{ $withdrawal->id }}" class="form-control" rows="4" 
                                                                      placeholder="Jelaskan alasan penolakan..." required 
                                                                      onclick="console.log('Textarea clicked for withdrawal {{ $withdrawal->id }}')"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" onclick="closeModal('rejectModal{{ $withdrawal->id }}')">Batal</button>
                                                        <button type="submit" class="btn btn-danger" onclick="console.log('Reject form submitted for withdrawal {{ $withdrawal->id }}')">Tolak Penarikan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $withdrawals->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada data penarikan</h5>
                            <p class="text-muted">Belum ada freelancer yang mengajukan penarikan dana.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Data Penarikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="GET" action="{{ route('admin.withdrawals.export') }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="export_status" class="form-label">Status</label>
                        <select name="status" id="export_status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="export_date_from" class="form-label">Dari Tanggal</label>
                            <input type="date" name="date_from" id="export_date_from" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="export_date_to" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="date_to" id="export_date_to" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download"></i> Download CSV
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        onload="console.log('jQuery loaded successfully')" 
        onerror="console.log('jQuery failed to load')"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous" 
        onload="console.log('Bootstrap JS loaded successfully')" 
        onerror="console.log('Bootstrap JS failed to load')"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Admin withdrawals page loaded');
    console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
    if (typeof bootstrap !== 'undefined') {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
        console.log('Bootstrap dropdowns initialized:', dropdownList.length);
    }
    window.openRejectModal = function(withdrawalId) {
        console.log('Opening reject modal for withdrawal:', withdrawalId);
        const modal = document.getElementById('rejectModal' + withdrawalId);
        if (modal) {
            modal.style.display = 'block';
            modal.classList.add('show');
            modal.classList.add('fade');
            document.body.classList.add('modal-open');
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'backdrop' + withdrawalId;
            backdrop.onclick = function() {
                closeModal('rejectModal' + withdrawalId);
            };
            document.body.appendChild(backdrop);
            const textarea = modal.querySelector('textarea');
            if (textarea) {
                setTimeout(() => textarea.focus(), 300);
            }
            console.log('Modal opened successfully');
        } else {
            console.error('Modal not found: rejectModal' + withdrawalId);
        }
    };
    window.closeModal = function(modalId) {
        console.log('Closing modal:', modalId);
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
            const withdrawalId = modalId.replace('rejectModal', '');
            const backdrop = document.getElementById('backdrop' + withdrawalId);
            if (backdrop) {
                backdrop.remove();
            }
            const allBackdrops = document.querySelectorAll('.modal-backdrop');
            allBackdrops.forEach(bd => bd.remove());
            console.log('Modal closed successfully');
        }
    };
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-close') || 
            e.target.getAttribute('data-bs-dismiss') === 'modal') {
            const modal = e.target.closest('.modal');
            if (modal) {
                closeModal(modal.id);
            }
        }
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('action') === 'approved' || urlParams.get('action') === 'rejected') {
        setTimeout(() => {
            window.location.href = '{{ route("admin.withdrawals.index") }}';
        }, 2000);
    }
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
