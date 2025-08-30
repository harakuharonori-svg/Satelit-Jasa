<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - SatelitJasa</title>
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
    .order-card {
        background: var(--primary-white);
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }
    .order-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    .order-image {
        width: 120px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }
    .order-card:hover .order-image {
        transform: scale(1.05);
    }
    .order-image-placeholder {
        width: 120px;
        height: 100px;
        background: var(--soft-gray);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-gray);
        border: 2px dashed var(--border-gray);
    }
    .order-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    .order-meta {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .order-meta i {
        width: 16px;
        margin-right: 0.5rem;
    }
    .price-badge {
        background: linear-gradient(135deg, var(--primary-black) 0%, #333 100%);
        color: var(--primary-white);
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 1.1rem;
        display: inline-block;
        margin-bottom: 1rem;
    }
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: inline-flex;
        align-items: center;
    }
    .status-pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .status-accepted {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    .status-in_progress {
        background: #cce7ff;
        color: #0056b3;
        border: 1px solid #b3d7ff;
    }
    .status-completed {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .status-delivered {
        background: #ffe6e6;
        color: #a8474a;
        border: 1px solid #f5c6cb;
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
        border: 1px solid #f5c6cb;
    }
    .payment-badge {
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-weight: 500;
    }
    .payment-paid {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .payment-pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    .btn-action {
        border: 2px solid var(--primary-black);
        color: var(--primary-black);
        background: transparent;
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        margin: 0.25rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 0.9rem;
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
    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: var(--primary-white);
        border-radius: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }
    .empty-state i {
        font-size: 4rem;
        color: var(--text-gray);
        margin-bottom: 2rem;
        opacity: 0.7;
    }
    .empty-state h4 {
        color: var(--primary-black);
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .empty-state p {
        color: var(--text-gray);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    .pagination-modern {
        justify-content: center;
        margin-top: 3rem;
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
        .section-title {
            font-size: 2rem;
        }
        .order-image,
        .order-image-placeholder {
            width: 80px;
            height: 80px;
        }
        .order-title {
            font-size: 1.1rem;
        }
        .btn-action {
            display: block;
            margin: 0.5rem 0;
            text-align: center;
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
                        <h1 class="section-title">Pesanan Saya</h1>
                        <p class="section-subtitle">Kelola dan pantau semua pesanan jasa Anda</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="/" class="btn-action">
                            <i class="fas fa-plus me-2"></i>
                            Pesan Jasa Baru
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
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Halaman ini hanya menampilkan pesanan yang sudah dibayar. Pesanan yang belum dibayar tidak akan muncul di sini.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @if($orders->count() > 0)
                <div class="row">
                    @foreach($orders as $order)
                    <div class="col-12">
                        <div class="order-card">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if($order->jasa && $order->jasa->banners && $order->jasa->banners->count() > 0)
                                            @php
                                                $banner = $order->jasa->banners->first();
                                                $imagePath = $banner->image;
                                                $imageUrl = asset('storage/' . $imagePath);
                                            @endphp
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $order->jasa->judul }}" 
                                                 class="order-image"
                                                 loading="lazy"
                                                 onload="console.log('Image loaded successfully: {{ $imageUrl }}');"
                                                 onerror="console.log('Image failed to load: {{ $imageUrl }}'); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="order-image-placeholder" style="display: none;">
                                                <i class="fas fa-image fa-2x"></i>
                                                <div style="font-size: 10px; margin-top: 5px;">Failed to load</div>
                                            </div>
                                        @else
                                            <div class="order-image-placeholder">
                                                <i class="fas fa-image fa-2x"></i>
                                                <div style="font-size: 10px; margin-top: 5px;">No banner</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h5 class="order-title">{{ $order->jasa->judul ?? 'Jasa Tidak Tersedia' }}</h5>
                                                <div class="order-meta">
                                                    <i class="fas fa-store"></i>
                                                    <strong>{{ $order->jasa->store->nama ?? 'Toko Tidak Tersedia' }}</strong>
                                                </div>
                                                <div class="order-meta">
                                                    <i class="fas fa-user"></i>
                                                    {{ $order->jasa->store->user->nama ?? 'Freelancer Tidak Tersedia' }}
                                                </div>
                                                <div class="order-meta">
                                                    <i class="fas fa-calendar"></i>
                                                    Dipesan: {{ $order->created_at->format('d M Y, H:i') }}
                                                </div>
                                                @if($order->deadline)
                                                <div class="order-meta">
                                                    <i class="fas fa-clock"></i>
                                                    Deadline: {{ $order->deadline->format('d M Y') }}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-lg-4 text-lg-end">
                                                <div class="price-badge">
                                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                                </div>
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
                                                    <i class="fas fa-{{ $statusIcon }} me-1"></i>
                                                    {{ $statusText }}
                                                </div>
                                                <div class="payment-badge {{ ($order->payment_status ?? 'pending') === 'paid' ? 'payment-paid' : 'payment-pending' }}">
                                                    <i class="fas fa-{{ ($order->payment_status ?? 'pending') === 'paid' ? 'check-circle' : 'clock' }} me-1"></i>
                                                    {{ ($order->payment_status ?? 'pending') === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn-action">
                                                    <i class="fas fa-eye me-1"></i>
                                                    Detail Pesanan
                                                </a>
                                                @if($orderStatus === 'completed' && !empty($order->delivery_file))
                                                    <a href="{{ route('orders.download', $order->id) }}" class="btn-action btn-success">
                                                        <i class="fas fa-download me-1"></i>
                                                        Download File
                                                    </a>
                                                @endif
                                                @if($orderStatus === 'cancelled' && ($order->refund_status ?? 'none') === 'none')
                                                    <form action="{{ route('orders.request-refund', $order->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn-action btn-warning" onclick="return confirm('Yakin ingin mengajukan refund?')">
                                                            <i class="fas fa-money-bill-wave me-1"></i>
                                                            Ajukan Refund
                                                        </button>
                                                    </form>
                                                @elseif(($order->refund_status ?? 'none') === 'pending')
                                                    <span class="btn-action" style="opacity: 0.6; cursor: not-allowed;">
                                                        <i class="fas fa-hourglass-half me-1"></i>
                                                        Refund Diproses
                                                    </span>
                                                @elseif(($order->refund_status ?? 'none') === 'completed')
                                                    <span class="btn-action btn-success" style="opacity: 0.6; cursor: not-allowed;">
                                                        <i class="fas fa-check me-1"></i>
                                                        Refund Selesai
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($orders->hasPages())
                    <nav aria-label="Orders pagination">
                        <ul class="pagination pagination-modern">
                            {{-- Previous Page Link --}}
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->previousPageUrl() }}">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif
                            {{-- Pagination Elements --}}
                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                            {{-- Next Page Link --}}
                            @if ($orders->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->nextPageUrl() }}">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-shopping-bag"></i>
                    <h4>Belum Ada Pesanan yang Dibayar</h4>
                    <p>
                        Anda belum memiliki pesanan yang sudah dibayar.<br>
                        Pesanan hanya akan muncul di sini setelah Anda melakukan pembayaran.
                    </p>
                    <a href="/" class="btn-action">
                        <i class="fas fa-search me-2"></i>
                        Jelajahi Jasa
                    </a>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
