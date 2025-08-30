<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan #{{ $order->id }} - SatelitJasa</title>
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
        --success-green: #198754;
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
    .main-content {
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
        color: var(--primary-white);
        margin-bottom: 1rem;
    }
    .section-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0;
    }
    .btn-action {
        border: 2px solid var(--primary-white);
        color: var(--primary-white);
        background: transparent;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .btn-action:hover {
        background: var(--primary-white);
        color: var(--primary-black);
        text-decoration: none;
    }
    .detail-card {
        background: var(--primary-white);
        border: none;
        border-radius: 15px;
        box-shadow: var(--shadow-light);
        margin-bottom: 2rem;
        overflow: hidden;
    }
    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333 100%);
        color: var(--primary-white);
        padding: 1.5rem;
        border: none;
    }
    .card-header-custom h5 {
        margin: 0;
        font-weight: 600;
    }
    .order-image-large {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 10px;
    }
    .order-image-placeholder-large {
        width: 100%;
        height: 300px;
        background: var(--soft-gray);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-gray);
        border: 2px dashed var(--border-gray);
    }
    .info-row {
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-gray);
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }
    .info-value {
        color: var(--text-gray);
        font-size: 1.1rem;
    }
    .client-card {
        background: linear-gradient(135deg, var(--soft-gray) 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 2rem;
    }
    .client-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-black);
        color: var(--primary-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1rem;
    }
    .status-badge {
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: inline-flex;
        align-items: center;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
        border: 2px solid #ffeaa7;
    }
    .status-accepted {
        background: #d1ecf1;
        color: #0c5460;
        border: 2px solid #bee5eb;
    }
    .status-in_progress {
        background: #cce7ff;
        color: #0056b3;
        border: 2px solid #b3d7ff;
    }
    .status-completed {
        background: #d4edda;
        color: #155724;
        border: 2px solid #c3e6cb;
    }
    .status-delivered {
        background: #fff3cd;
        color: #856404;
        border: 2px solid #ffeaa7;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
        border: 2px solid #f5c6cb;
    }
    .price-display {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333 100%);
        color: var(--primary-white);
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 2rem;
    }
    .price-amount {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .btn-primary {
        border: 2px solid var(--primary-black);
        color: var(--primary-black);
        background: transparent;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        margin: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 1rem;
    }
    .btn-primary:hover {
        background: var(--primary-black);
        color: var(--primary-white);
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
        text-decoration: none;
    }
    .btn-primary.btn-success {
        border-color: var(--success-green);
        color: var(--success-green);
    }
    .btn-primary.btn-success:hover {
        background: var(--success-green);
        color: var(--primary-white);
    }
    .btn-primary.btn-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    .btn-primary.btn-danger:hover {
        background: #dc3545;
        color: var(--primary-white);
    }
    .btn-primary.btn-warning {
        border-color: #ffc107;
        color: #856404;
    }
    .btn-primary.btn-warning:hover {
        background: #ffc107;
        color: var(--primary-white);
    }
    .upload-area {
        border: 2px dashed var(--border-gray);
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: var(--soft-gray);
        transition: all 0.3s ease;
    }
    .upload-area:hover {
        border-color: var(--primary-black);
        background: rgba(0, 0, 0, 0.1);
    }
    .upload-area.dragover {
        border-color: var(--success-green);
        background: rgba(25, 135, 84, 0.1);
    }
    .form-control:focus {
        border-color: var(--primary-black);
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        .btn-primary {
            display: block;
            margin: 0.5rem 0;
            text-align: center;
        }
        .price-amount {
            font-size: 1.5rem;
        }
    }
</style>
<body>
    <x-navbar />
    <div class="main-content">
        <div class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="section-title">Kelola Pesanan #{{ $order->id }}</h1>
                        <p class="section-subtitle">Detail lengkap pesanan dari klien Anda</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('freelancer.orders.index') }}" class="btn-action">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Daftar
                        </a>
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
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-briefcase me-2"></i>Informasi Jasa</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($order->jasa && $order->jasa->banners && $order->jasa->banners->count() > 0)
                                        @php
                                            $banner = $order->jasa->banners->first();
                                            $imagePath = $banner->image;
                                            $imageUrl = asset('storage/' . $imagePath);
                                        @endphp
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $order->jasa->judul }}" 
                                             class="order-image-large"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="order-image-placeholder-large" style="display: none;">
                                            <i class="fas fa-image fa-3x"></i>
                                        </div>
                                    @else
                                        <div class="order-image-placeholder-large">
                                            <i class="fas fa-image fa-3x"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="info-row">
                                        <div class="info-label">Nama Jasa</div>
                                        <div class="info-value">{{ $order->jasa->judul ?? 'Jasa Tidak Tersedia' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">Deskripsi</div>
                                        <div class="info-value">{{ $order->jasa->deskripsi ?? 'Tidak ada deskripsi' }}</div>
                                    </div>
                                    @if($order->deskripsi_pesanan)
                                    <div class="info-row">
                                        <div class="info-label">Catatan dari Klien</div>
                                        <div class="info-value">{{ $order->deskripsi_pesanan }}</div>
                                    </div>
                                    @endif
                                    @if($order->deadline)
                                    <div class="info-row">
                                        <div class="info-label">Deadline</div>
                                        <div class="info-value">
                                            {{ $order->deadline->format('d M Y') }}
                                            @php
                                                $deadline = \Carbon\Carbon::parse($order->deadline);
                                                $daysLeft = $deadline->diffInDays(now(), false);
                                            @endphp
                                            @if($daysLeft >= 0 && ($order->order_status ?? 'pending') !== 'completed')
                                                <span class="text-danger fw-bold">
                                                    ({{ $daysLeft }} hari lagi)
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @php 
                        $orderStatus = $order->order_status ?? 'pending'; 
                        $projectStatus = $order->project_status ?? 'pending';
                    @endphp
                    @if($orderStatus === 'pending')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-handshake me-2"></i>Konfirmasi Pesanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="mb-4">Klien telah memesan jasa Anda. Silakan konfirmasi apakah Anda dapat mengerjakan pesanan ini.</p>
                            <form action="{{ route('freelancer.orders.accept', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <div class="mb-3">
                                    <label for="response" class="form-label">Pesan untuk klien (opsional)</label>
                                    <textarea name="response" id="response" class="form-control" rows="3" 
                                              placeholder="Tuliskan pesan konfirmasi untuk klien..."></textarea>
                                </div>
                                <button type="submit" class="btn-primary btn-success" onclick="return confirm('Terima pesanan ini?')">
                                    <i class="fas fa-handshake me-2"></i>
                                    Terima Pesanan
                                </button>
                            </form>
                            <form action="{{ route('freelancer.orders.reject', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <div class="mb-3 mt-3">
                                    <label for="reject_reason" class="form-label">Alasan penolakan</label>
                                    <textarea name="reject_reason" id="reject_reason" class="form-control" rows="3" 
                                              placeholder="Jelaskan alasan mengapa Anda menolak pesanan ini..." required></textarea>
                                </div>
                                <button type="submit" class="btn-primary btn-danger" onclick="return confirm('Tolak pesanan ini?')">
                                    <i class="fas fa-times me-2"></i>
                                    Tolak Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($orderStatus === 'accepted')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-play me-2"></i>Mulai Pengerjaan</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="mb-4">Pesanan telah diterima. Klik tombol di bawah untuk mulai mengerjakan pesanan ini.</p>
                            <form action="{{ route('freelancer.orders.start', $order->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="start_message" class="form-label">Pesan untuk klien</label>
                                    <textarea name="start_message" id="start_message" class="form-control" rows="3" 
                                              placeholder="Beri tahu klien bahwa Anda mulai mengerjakan..."></textarea>
                                </div>
                                <button type="submit" class="btn-primary btn-warning">
                                    <i class="fas fa-play me-2"></i>
                                    Mulai Mengerjakan
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($orderStatus === 'in_progress' && $projectStatus !== 'delivered' && $projectStatus !== 'completed')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-upload me-2"></i>Upload Hasil Pekerjaan</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="mb-4">Upload file hasil pekerjaan Anda untuk diserahkan kepada klien.</p>
                            <form action="{{ route('freelancer.orders.complete', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="delivery_file" class="form-label">File Hasil Pekerjaan</label>
                                    <div class="upload-area" onclick="document.getElementById('delivery_file').click()">
                                        <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
                                        <p class="mb-0">Klik untuk pilih file atau drag & drop</p>
                                        <small class="text-muted">Format: ZIP, RAR, PDF, DOC, DOCX (Max: 50MB)</small>
                                    </div>
                                    <input type="file" name="delivery_file" id="delivery_file" class="form-control d-none" 
                                           accept=".zip,.rar,.pdf,.doc,.docx" required>
                                    <div id="file-name" class="mt-2 text-muted"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="completion_message" class="form-label">Pesan Penyerahan</label>
                                    <textarea name="completion_message" id="completion_message" class="form-control" rows="4" 
                                              placeholder="Tuliskan pesan untuk klien tentang hasil pekerjaan Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn-primary btn-success">
                                    <i class="fas fa-check me-2"></i>
                                    Selesaikan Pesanan
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if($projectStatus === 'delivered')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-clock me-2"></i>Menunggu Konfirmasi Client</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <i class="fas fa-file-check fa-4x text-warning mb-3"></i>
                                <h4 class="text-warning">File Sudah Dikirim!</h4>
                                <p class="text-muted mb-4">Pekerjaan Anda telah diserahkan kepada klien. Menunggu konfirmasi dari klien untuk menyelesaikan pesanan ini.</p>
                                @if($order->delivery_file)
                                <div class="mb-3">
                                    <strong>File yang diserahkan:</strong><br>
                                    <a href="{{ asset('storage/' . $order->delivery_file) }}" class="btn btn-outline-primary" target="_blank">
                                        <i class="fas fa-download me-2"></i>
                                        Lihat File yang Dikirim
                                    </a>
                                </div>
                                @endif
                                @if($order->delivered_at)
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    Dikirim pada: {{ $order->delivered_at->format('d M Y H:i') }}
                                </small>
                                @endif
                                @if($order->freelancer_response)
                                <div class="mt-3 p-3 bg-light rounded">
                                    <strong>Pesan Penyerahan:</strong><br>
                                    <em>"{{ $order->freelancer_response }}"</em>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($projectStatus === 'completed')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-check-circle me-2"></i>Pesanan Selesai</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                                <h4 class="text-success">Pesanan Telah Selesai!</h4>
                                <p class="text-muted">Terima kasih telah menyelesaikan pesanan dengan baik.</p>
                                @if($order->delivery_file)
                                <div class="mt-3">
                                    <strong>File yang diserahkan:</strong><br>
                                    <a href="{{ asset('storage/' . $order->delivery_file) }}" class="btn-primary btn-success" target="_blank">
                                        <i class="fas fa-download me-2"></i>
                                        Download File
                                    </a>
                                </div>
                                @endif
                                @if($order->freelancer_response)
                                <div class="mt-3">
                                    <strong>Pesan penyerahan:</strong><br>
                                    <em>{{ $order->freelancer_response }}</em>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="client-card">
                        <div class="client-avatar">
                            {{ strtoupper(substr($order->user->nama ?? 'C', 0, 1)) }}
                        </div>
                        <h5 class="fw-bold">{{ $order->user->nama ?? 'Klien Tidak Tersedia' }}</h5>
                        <p class="text-muted mb-2">{{ $order->user->email ?? 'Email tidak tersedia' }}</p>
                        <small class="text-muted">Bergabung {{ $order->user->created_at ? $order->user->created_at->format('M Y') : '-' }}</small>
                    </div>
                    <div class="price-display">
                        <div class="price-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        <div>Total Pembayaran</div>
                    </div>
                    <div class="detail-card">
                        <div class="card-body p-4 text-center">
                            @php
                                if ($projectStatus === 'delivered') {
                                    $displayStatus = 'delivered';
                                    $statusText = 'File Dikirim - Menunggu Konfirmasi';
                                    $statusClass = 'status-delivered';
                                    $statusIcon = 'clock';
                                } elseif ($projectStatus === 'completed') {
                                    $displayStatus = 'completed';
                                    $statusText = 'Selesai';
                                    $statusClass = 'status-completed';
                                    $statusIcon = 'check-circle';
                                } else {
                                    $displayStatus = $orderStatus;
                                    $statusClass = match($orderStatus) {
                                        'pending' => 'status-pending',
                                        'accepted' => 'status-accepted', 
                                        'in_progress' => 'status-in_progress',
                                        'completed' => 'status-completed',
                                        'cancelled' => 'status-cancelled',
                                        default => 'status-pending'
                                    };
                                    $statusText = match($orderStatus) {
                                        'pending' => 'Menunggu Konfirmasi',
                                        'accepted' => 'Diterima',
                                        'in_progress' => 'Sedang Dikerjakan', 
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => 'Menunggu Konfirmasi'
                                    };
                                    $statusIcon = match($orderStatus) {
                                        'pending' => 'clock',
                                        'accepted' => 'handshake',
                                        'in_progress' => 'cog fa-spin',
                                        'completed' => 'check-circle',
                                        'cancelled' => 'times-circle',
                                        default => 'clock'
                                    };
                                }
                            @endphp
                            <div class="status-badge {{ $statusClass }}">
                                <i class="fas fa-{{ $statusIcon }} me-2"></i>
                                {{ $statusText }}
                            </div>
                            <div class="info-row">
                                <div class="info-label">ID Pesanan</div>
                                <div class="info-value">#{{ $order->id }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Tanggal Pesanan</div>
                                <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Status Pembayaran</div>
                                <div class="info-value">
                                    @if(($order->payment_status ?? 'pending') === 'paid')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Lunas
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-clock me-1"></i>
                                            Belum Bayar
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('freelancer.orders.index') }}" class="btn-primary">
                                    <i class="fas fa-list me-2"></i>
                                    Lihat Semua Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        document.getElementById('delivery_file').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const fileNameDiv = document.getElementById('file-name');
            if (fileName) {
                fileNameDiv.innerHTML = `<strong>File dipilih:</strong> ${fileName}`;
                fileNameDiv.className = 'mt-2 text-success';
            } else {
                fileNameDiv.innerHTML = '';
            }
        });
        const uploadArea = document.querySelector('.upload-area');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        function highlight(e) {
            uploadArea.classList.add('dragover');
        }
        function unhighlight(e) {
            uploadArea.classList.remove('dragover');
        }
        uploadArea.addEventListener('drop', handleDrop, false);
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('delivery_file').files = files;
            const event = new Event('change');
            document.getElementById('delivery_file').dispatchEvent(event);
        }
    </script>
</body>
</html>
