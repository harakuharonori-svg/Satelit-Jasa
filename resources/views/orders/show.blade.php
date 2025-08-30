<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<style>
    :root {
        --primary-black: #000000;
        --primary-white: #ffffff;
        --soft-gray: #f8f9fa;
        --border-gray: #e9ecef;
        --text-gray: #6c757d;
        --success-green: #198754;
        --hover-gray: #f1f3f4;
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
        background: var(--primary-white);
        padding: 3rem 0;
        margin-bottom: 3rem;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 1rem;
    }
    .section-subtitle {
        font-size: 1.1rem;
        color: var(--text-gray);
        margin-bottom: 0;
    }
    .detail-card {
        background: var(--primary-white);
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
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
        background: #ffe6e6;
        color: #a8474a;
        border: 2px solid #f5c6cb;
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
    .btn-action {
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
    .btn-action:hover {
        background: var(--primary-black);
        color: var(--primary-white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-action.btn-success {
        border-color: var(--success-green);
        color: var(--success-green);
    }
    .btn-action.btn-success:hover {
        background: var(--success-green);
        color: var(--primary-white);
    }
    .btn-action.btn-warning {
        border-color: #ffc107;
        color: #856404;
    }
    .btn-action.btn-warning:hover {
        background: #ffc107;
        color: var(--primary-white);
    }
    .timeline {
        position: relative;
        padding: 2rem 0;
    }
    .timeline-item {
        position: relative;
        padding-left: 3rem;
        margin-bottom: 2rem;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 15px;
        height: 15px;
        background: var(--primary-black);
        border-radius: 50%;
        border: 3px solid var(--primary-white);
        box-shadow: 0 0 0 3px var(--primary-black);
    }
    .timeline-item::after {
        content: '';
        position: absolute;
        left: 7px;
        top: 15px;
        width: 2px;
        height: calc(100% + 2rem);
        background: var(--border-gray);
    }
    .timeline-item:last-child::after {
        display: none;
    }
    .timeline-content {
        background: var(--primary-white);
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .timeline-date {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .timeline-title {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }
    .file-download {
        background: var(--success-green);
        color: var(--primary-white);
        padding: 1rem;
        border-radius: 10px;
        margin: 1rem 0;
        text-align: center;
    }
    .file-download a {
        color: var(--primary-white);
        text-decoration: none;
        font-weight: 600;
    }
    .file-download a:hover {
        text-decoration: underline;
    }
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        .btn-action {
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
                        <h1 class="section-title">Detail Pesanan</h1>
                        <p class="section-subtitle">Informasi lengkap pesanan Anda</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('orders.index') }}" class="btn-action">
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
                                    <div class="info-row">
                                        <div class="info-label">Freelancer</div>
                                        <div class="info-value">{{ $order->jasa->store->user->nama ?? 'Freelancer Tidak Tersedia' }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">Toko</div>
                                        <div class="info-value">{{ $order->jasa->store->nama ?? 'Toko Tidak Tersedia' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-shopping-cart me-2"></i>Informasi Pesanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-row">
                                        <div class="info-label">ID Pesanan</div>
                                        <div class="info-value">#{{ $order->id }}</div>
                                    </div>
                                    <div class="info-row">
                                        <div class="info-label">Tanggal Pesanan</div>
                                        <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    @if($order->deadline)
                                    <div class="info-row">
                                        <div class="info-label">Deadline</div>
                                        <div class="info-value">{{ $order->deadline->format('d M Y') }}</div>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
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
                                    @if($order->deskripsi_pesanan)
                                    <div class="info-row">
                                        <div class="info-label">Catatan Pesanan</div>
                                        <div class="info-value">{{ $order->deskripsi_pesanan }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-history me-2"></i>Timeline Pesanan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-content">
                                        <div class="timeline-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                        <div class="timeline-title">Pesanan Dibuat</div>
                                        <div class="text-muted">Pesanan berhasil dibuat dan menunggu konfirmasi freelancer</div>
                                    </div>
                                </div>
                                @if(($order->order_status ?? 'pending') !== 'pending')
                                <div class="timeline-item">
                                    <div class="timeline-content">
                                        <div class="timeline-date">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                                        <div class="timeline-title">
                                            @switch($order->order_status ?? 'pending')
                                                @case('accepted')
                                                    Pesanan Diterima
                                                    @break
                                                @case('in_progress')
                                                    Pesanan Sedang Dikerjakan
                                                    @break
                                                @case('completed')
                                                    Pesanan Selesai
                                                    @break
                                                @case('cancelled')
                                                    Pesanan Dibatalkan
                                                    @break
                                                @default
                                                    Status Diperbarui
                                            @endswitch
                                        </div>
                                        <div class="text-muted">
                                            @if($order->freelancer_response)
                                                {{ $order->freelancer_response }}
                                            @else
                                                Status pesanan telah diperbarui oleh freelancer
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if(($order->order_status ?? 'pending') === 'completed' && $order->delivery_file)
                                <div class="timeline-item">
                                    <div class="timeline-content">
                                        <div class="timeline-date">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                                        <div class="timeline-title">File Delivery Tersedia</div>
                                        <div class="text-muted">Freelancer telah mengupload file hasil pekerjaan</div>
                                        <div class="file-download">
                                            <i class="fas fa-download me-2"></i>
                                            <a href="{{ route('orders.download', $order->id) }}">Download File Hasil</a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="price-display">
                        <div class="price-amount">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        <div>Total Pembayaran</div>
                    </div>
                    <div class="detail-card">
                        <div class="card-body p-4 text-center">
                            @php
                                $orderStatus = $order->order_status ?? 'pending';
                                $projectStatus = $order->project_status ?? 'pending';
                                if ($projectStatus === 'delivered' && !empty($order->delivery_file)) {
                                    $displayStatus = 'delivered';
                                    $statusText = 'Menunggu Konfirmasi Anda';
                                    $statusClass = 'status-delivered';
                                    $statusIcon = 'eye';
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
                                        'accepted' => 'Diterima Freelancer',
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
                            <div class="d-grid gap-2">
                                @if($displayStatus === 'delivered' && !empty($order->delivery_file))
                                    <a href="{{ route('orders.download', $order->id) }}" class="btn-action btn-info mb-2">
                                        <i class="fas fa-download me-2"></i>
                                        Download File Hasil
                                    </a>
                                    <form action="{{ route('orders.confirm-delivery', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action btn-success w-100" 
                                                onclick="return confirm('Konfirmasi bahwa pekerjaan sudah selesai dan sesuai? Uang akan dilepas ke freelancer.')">
                                            <i class="fas fa-check-circle me-2"></i>
                                            Konfirmasi Pekerjaan Selesai
                                        </button>
                                    </form>
                                @elseif($displayStatus === 'delivered' && empty($order->delivery_file))
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Freelancer belum mengirim file hasil pekerjaan. Status akan berubah otomatis setelah file diupload.
                                    </div>
                                @endif
                                @if($displayStatus === 'completed' && !empty($order->delivery_file))
                                    <a href="{{ route('orders.download', $order->id) }}" class="btn-action btn-success">
                                        <i class="fas fa-download me-2"></i>
                                        Download File
                                    </a>
                                @endif
                                @if($displayStatus === 'cancelled' && ($order->refund_status ?? 'none') === 'none')
                                    <form action="{{ route('orders.request-refund', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-action btn-warning w-100" onclick="return confirm('Yakin ingin mengajukan refund?')">
                                            <i class="fas fa-money-bill-wave me-2"></i>
                                            Ajukan Refund
                                        </button>
                                    </form>
                                @elseif(($order->refund_status ?? 'none') === 'pending')
                                    <span class="btn-action w-100" style="opacity: 0.6; cursor: not-allowed;">
                                        <i class="fas fa-hourglass-half me-2"></i>
                                        Refund Diproses
                                    </span>
                                @elseif(($order->refund_status ?? 'none') === 'completed')
                                    <span class="btn-action btn-success w-100" style="opacity: 0.6; cursor: not-allowed;">
                                        <i class="fas fa-check me-2"></i>
                                        Refund Selesai
                                    </span>
                                @endif
                                <a href="{{ route('orders.index') }}" class="btn-action">
                                    <i class="fas fa-list me-2"></i>
                                    Lihat Semua Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                    @if($orderStatus !== 'cancelled')
                    <div class="detail-card">
                        <div class="card-header-custom">
                            <h5><i class="fas fa-comments me-2"></i>Hubungi Freelancer</h5>
                        </div>
                        <div class="card-body p-4 text-center">
                            <p class="text-muted mb-3">Butuh diskusi tentang pesanan ini?</p>
                            <a href="#" class="btn-action" onclick="alert('Fitur chat akan segera tersedia!')">
                                <i class="fas fa-envelope me-2"></i>
                                Kirim Pesan
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
