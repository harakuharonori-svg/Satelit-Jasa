<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - SatelitJasa</title>
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
        .freelancer-orders-page {
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
        .stats-cards {
            margin-top: 2rem;
        }
        .stat-card {
            background: var(--primary-white);
            border: none;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
            margin-bottom: 1rem;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-black);
            margin-bottom: 0.5rem;
        }
        .stat-label {
            font-size: 1rem;
            color: var(--text-gray);
            font-weight: 500;
        }
        .main-content {
            padding-bottom: 4rem;
        }
        .content-section {
            margin-bottom: 3rem;
        }
        .filter-section {
            background: var(--primary-white);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            margin-bottom: 2rem;
        }
        .filter-section h3 {
            color: var(--primary-black);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .alert-info {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            border-radius: 10px;
            padding: 1rem;
            font-size: 0.9rem;
        }
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .filter-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--border-gray);
            border-radius: 25px;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            background: var(--primary-white);
        }
        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--primary-black);
            color: var(--primary-black);
            background: var(--soft-gray);
            text-decoration: none;
        }
        .service-card {
            background: var(--primary-white);
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }
        .service-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid var(--border-gray);
        }
        .service-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .order-id {
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 500;
        }
        .order-status {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-accepted {
            background: #d1ecf1;
            color: #0c5460;
        }
        .status-in_progress {
            background: #cce7ff;
            color: #0056b3;
        }
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        .service-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-black);
            margin: 0;
            line-height: 1.4;
        }
        .service-info {
            padding: 1rem 1.5rem;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
            color: var(--text-gray);
            font-size: 0.95rem;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
        .info-item .icon {
            width: 16px;
            margin-right: 0.8rem;
            color: var(--primary-black);
        }
        .service-actions {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-gray);
        }
        .btn-primary {
            background: var(--primary-black);
            border: 2px solid var(--primary-black);
            color: var(--primary-white);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-primary:hover {
            background: transparent;
            color: var(--primary-black);
            text-decoration: none;
        }
        .btn-sm {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--primary-white);
            border-radius: 15px;
            box-shadow: var(--shadow-light);
        }
        .empty-state i {
            font-size: 4rem;
            color: var(--text-gray);
            margin-bottom: 1.5rem;
        }
        .empty-state h3 {
            color: var(--primary-black);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .empty-state p {
            color: var(--text-gray);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
        }
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            .filter-buttons {
                flex-direction: column;
            }
            .filter-btn {
                text-align: center;
            }
            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>
<body>
    <x-navbar />
    <div class="freelancer-orders-page">
        <div class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="section-title">
                            <i class="fas fa-briefcase me-3"></i>
                            Kelola Pesanan
                        </h1>
                        <p class="section-subtitle">Dashboard untuk mengelola semua pesanan dari klien Anda</p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="/profil/" class="btn-action">
                            <i class="fas fa-user me-2"></i>
                            Profil Saya
                        </a>
                    </div>
                </div>
                <div class="row stats-cards">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['pending'] }}</div>
                            <div class="stat-label">Menunggu Konfirmasi</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['in_progress'] }}</div>
                            <div class="stat-label">Sedang Dikerjakan</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number">{{ $stats['completed'] }}</div>
                            <div class="stat-label">Selesai</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number">Rp {{ number_format($stats['total_earnings'], 0, ',', '.') }}</div>
                            <div class="stat-label">Total Pendapatan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <main class="main-content">
            <div class="container">
                <div class="content-section">
                    <div class="row">
                        <div class="col-12">
                            <div class="filter-section">
                                <h3>Filter Pesanan</h3>
                                <div class="alert alert-info mb-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Catatan:</strong> Hanya pesanan yang sudah dibayar yang ditampilkan di sini.
                                </div>
                                <div class="filter-buttons">
                                    <a href="{{ route('freelancer.orders.index') }}" 
                                       class="filter-btn {{ !request('status') ? 'active' : '' }}">
                                        Semua
                                    </a>
                                    <a href="{{ route('freelancer.orders.index', ['status' => 'pending']) }}" 
                                       class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">
                                        Menunggu Konfirmasi
                                    </a>
                                    <a href="{{ route('freelancer.orders.index', ['status' => 'in_progress']) }}" 
                                       class="filter-btn {{ request('status') == 'in_progress' ? 'active' : '' }}">
                                        Sedang Dikerjakan
                                    </a>
                                    <a href="{{ route('freelancer.orders.index', ['status' => 'completed']) }}" 
                                       class="filter-btn {{ request('status') == 'completed' ? 'active' : '' }}">
                                        Selesai
                                    </a>
                                    <a href="{{ route('freelancer.orders.index', ['status' => 'cancelled']) }}" 
                                       class="filter-btn {{ request('status') == 'cancelled' ? 'active' : '' }}">
                                        Dibatalkan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-section">
                    <div class="row">
                        @forelse($orders as $order)
                            <div class="col-lg-6 col-xl-4 mb-4">
                                <div class="service-card">
                                    <div class="service-header">
                                        <div class="service-meta">
                                            <span class="order-id">#{{ $order->id }}</span>
                                            <span class="order-status status-{{ $order->order_status }}">
                                                {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                            </span>
                                        </div>
                                        <h4 class="service-title">{{ $order->jasa->nama_jasa }}</h4>
                                    </div>
                                    <div class="service-info">
                                        <div class="info-item">
                                            <i class="fas fa-user icon"></i>
                                            <span>{{ $order->user->nama }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-calendar icon"></i>
                                            <span>{{ $order->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-rupiah-sign icon"></i>
                                            <span>Rp {{ number_format($order->total_pembayaran, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="service-actions">
                                        <a href="{{ route('freelancer.orders.show', $order->id) }}" 
                                           class="btn-primary btn-sm w-100">
                                            <i class="fas fa-eye me-2"></i>
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h3>Belum Ada Pesanan yang Dibayar</h3>
                                    <p>Anda belum memiliki pesanan yang sudah dibayar. Pesanan hanya akan muncul di sini setelah klien melakukan pembayaran.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    @if($orders->hasPages())
                        <div class="row">
                            <div class="col-12">
                                <div class="pagination-wrapper">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
