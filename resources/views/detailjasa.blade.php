<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jasa - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    :root {
        --primary-black: #000000;
        --primary-white: #ffffff;
        --soft-gray: #f8f9fa;
        --border-gray: #e9ecef;
        --text-gray: #6c757d;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: var(--primary-black);
        background: var(--soft-gray);
    }

    
    .navbar-modern {
        background: var(--primary-white) !important;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        padding: 1rem 0;
    }

    .navbar-brand img {
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
        transform: scale(1.05);
    }

    .nav-link {
        color: var(--primary-black) !important;
        font-weight: 500;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-link:hover {
        color: var(--text-gray) !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 50%;
        background-color: var(--primary-black);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .profile-img {
        width: 40px;
        height: 40px;
        border: 2px solid var(--primary-black);
        transition: all 0.3s ease;
    }

    .profile-img:hover {
        transform: scale(1.1);
        border-color: var(--text-gray);
    }

    
    .dropdown-menu {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
        margin-top: 0.5rem;
        background: var(--primary-white);
        min-width: 200px;
        animation: fadeInUp 0.3s ease;
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        color: var(--primary-black) !important;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 0.25rem 0.5rem;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background: var(--primary-black) !important;
        color: var(--primary-white) !important;
        transform: translateX(5px);
    }

    .dropdown-item-icon {
        width: 16px;
        height: 16px;
        margin-right: 0.75rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .dropdown-item:hover .dropdown-item-icon {
        opacity: 1;
    }

    .dropdown-divider {
        margin: 0.5rem 1rem;
        border-color: var(--border-gray);
    }

    
    .main-container {
        margin-top: 100px;
        padding-bottom: 3rem;
    }

    
    .image-carousel {
        background: var(--primary-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .carousel-item {
        height: 500px;
        background: var(--soft-gray);
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    
    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background: var(--primary-white);
        border-radius: 50%;
        opacity: 0.9;
        transition: all 0.3s ease;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        transform: translateY(-50%) scale(1.1);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: transparent;
        border-radius: 0;
        width: 20px;
        height: 20px;
        background-size: 100%, 100%;
        filter: invert(1);
    }

    
    .service-details {
        background: var(--primary-white);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .service-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .provider-info {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: var(--soft-gray);
        border-radius: 15px;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }

    .provider-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        color: inherit;
        text-decoration: none;
    }

    .provider-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-black);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .provider-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-black);
        margin: 0;
    }

    .action-btns {
        margin: 1.5rem 0;
    }

    .btn-primary-custom {
        background: var(--primary-black);
        border: 2px solid var(--primary-black);
        color: var(--primary-white);
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        margin-bottom: 1rem;
    }

    .btn-primary-custom:hover {
        background: transparent;
        color: var(--primary-black);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-custom {
        background: transparent;
        border: 2px solid var(--primary-black);
        color: var(--primary-black);
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-outline-custom:hover {
        background: var(--primary-black);
        color: var(--primary-white);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-edit-jasa {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: var(--primary-white);
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-edit-jasa:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: var(--primary-white);
        text-decoration: none;
    }

    .btn-edit-jasa:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-edit-jasa:hover:before {
        left: 100%;
    }

    .btn-edit-jasa i {
        filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.2));
    }

    .owner-message {
        margin: 1.5rem 0;
    }

    .owner-message .alert {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-left: 4px solid #2196f3;
        padding: 1.25rem;
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.1);
    }

    .owner-message .alert i {
        color: #1976d2;
        font-size: 1.25rem;
    }

    .owner-message .alert strong {
        color: #1565c0;
        font-weight: 600;
    }

    .owner-message .alert small {
        color: #1976d2;
        opacity: 0.8;
    }

    .section-heading {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-black);
        margin: 2rem 0 1rem 0;
        border-bottom: 2px solid var(--border-gray);
        padding-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .section-heading i {
        margin-right: 0.5rem;
    }

    .description {
        color: var(--text-gray);
        line-height: 1.8;
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    
    .recommendations {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        padding: 1rem 0;
        scroll-behavior: smooth;
    }

    .recommendations::-webkit-scrollbar {
        height: 8px;
    }

    .recommendations::-webkit-scrollbar-track {
        background: var(--soft-gray);
        border-radius: 10px;
    }

    .recommendations::-webkit-scrollbar-thumb {
        background: var(--primary-black);
        border-radius: 10px;
    }

    .rec-card {
        min-width: 250px;
        background: var(--primary-white);
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        text-decoration: none;
        color: inherit;
    }

    .rec-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        text-decoration: none;
        color: inherit;
    }

    .rec-card img {
        height: 150px;
        object-fit: cover;
        transition: transform 0.3s ease;
        width: 100%;
    }

    .rec-card:hover img {
        transform: scale(1.05);
    }

    .rec-card .card-body {
        padding: 1rem;
    }

    .rec-card .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }

    .rec-card .card-text {
        color: var(--text-gray);
        font-size: 0.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    
    @media (max-width: 768px) {
        .main-container {
            margin-top: 80px;
        }

        .service-details {
            padding: 1.5rem;
        }

        .service-title {
            font-size: 1.5rem;
        }

        .btn-edit-jasa {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .d-flex.justify-content-between.align-items-start {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .carousel-item {
            height: 300px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
        }

        .carousel-control-prev {
            left: 15px;
        }

        .carousel-control-next {
            right: 15px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 16px;
            height: 16px;
        }

        .provider-info {
            flex-direction: column;
            text-align: center;
        }

        .provider-avatar {
            margin-right: 0;
            margin-bottom: 0.5rem;
        }

        .rec-card {
            min-width: 200px;
        }
    }

    @media (max-width: 576px) {
        .carousel-item {
            height: 250px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 35px;
            height: 35px;
        }

        .carousel-control-prev {
            left: 10px;
        }

        .carousel-control-next {
            right: 10px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 14px;
            height: 14px;
        }
    }
</style>

<body>
    
    <x-navbar/>

    
    <div class="container main-container">
        
        <div class="image-carousel">
            <div id="carouselExampleDark" class="carousel carousel-dark slide">
                @if($jasa->jasa_banners->count() > 0)
                    <div class="carousel-indicators">
                        @foreach($jasa->jasa_banners as $index => $banner)
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index == 0 ? 'active' : '' }}" 
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($jasa->jasa_banners as $index => $banner)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ $jasa->judul }}" />
                            </div>
                        @endforeach
                    </div>
                    @if($jasa->jasa_banners->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                @else
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/images/logo-picture.jpg" class="d-block w-100" alt="Default Image" />
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detail Jasa -->
        <div class="service-details">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h1 class="service-title mb-0">{{ $jasa->judul }}</h1>
                @auth
                    @if(Auth::user()->id == $store->id_user)
                        <a href="/editjasa/{{ $jasa->id }}" class="btn btn-edit-jasa">
                            <i class="fas fa-edit me-2"></i>Edit Jasa
                        </a>
                    @endif
                @endauth
            </div>
            
            <a href="{{ route('toko.show', $store->id) }}" class="provider-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($store->user->name) }}&background=000000&color=ffffff&size=50" 
                     alt="Provider Avatar" class="provider-avatar">
                <div>
                    <h5 class="provider-name">{{ $store->user->name }}</h5>
                    <small class="text-muted">{{ $store->nama }} • {{ $totalServices }} Jasa • {{ $completedProjects }} Proyek Selesai</small>
                </div>
            </a>

            <hr />

            <div class="action-btns">
                @auth
                    @if(Auth::user()->id !== $store->id_user)
                        <a href="/detail/pembayaran/{{ $jasa->id }}" class="text-decoration-none">
                            <button class="btn btn-primary-custom" type="button">
                                <i class="fas fa-credit-card me-2"></i>Lanjutkan
                            </button>
                        </a>

                        <a href="/chat/{{ $store->id }}" class="text-decoration-none">
                            <button class="btn btn-outline-custom" type="button">
                                <i class="fas fa-comment me-2"></i>Pesan {{ $store->nama }}
                            </button>
                        </a>
                    @else
                        <div class="owner-message">
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-info-circle me-3"></i>
                                <div>
                                    <strong>Ini adalah jasa Anda!</strong><br>
                                    <small>Anda dapat mengedit jasa ini menggunakan tombol "Edit Jasa" di atas.</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <a href="/detail/pembayaran/{{ $jasa->id }}" class="text-decoration-none">
                        <button class="btn btn-primary-custom" type="button">
                            <i class="fas fa-credit-card me-2"></i>Lanjutkan
                        </button>
                    </a>

                    <a href="/chat/{{ $store->id }}" class="text-decoration-none">
                        <button class="btn btn-outline-custom" type="button">
                            <i class="fas fa-comment me-2"></i>Pesan {{ $store->nama }}
                        </button>
                    </a>
                @endauth
            </div>

            <h6 class="section-heading">
                <i class="fas fa-info-circle"></i>Penjelasan Jasa
            </h6>
            <p class="description">
                {{ $jasa->deskripsi }}
            </p>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Kategori:</strong>
                    @if($jasa->kategoris->count() > 0)
                        @foreach($jasa->kategoris as $kategori)
                            <span class="badge bg-secondary me-1">{{ $kategori->nama }}</span>
                        @endforeach
                    @else
                        <span class="badge bg-light text-dark">Belum ada kategori</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <strong>Harga:</strong>
                    <span class="h5 text-success">Rp {{ number_format($jasa->harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <h6 class="section-heading">
                <i class="fas fa-thumbs-up"></i>Rekomendasi Untukmu
            </h6>
            <div class="recommendations">
                @foreach ($recommendations as $recJasa)
                    <a href="{{ route('jasa.detail', $recJasa->id) }}" class="rec-card">
                        <div class="overflow-hidden">
                            @if($recJasa->jasa_banners->count() > 0)
                                <img src="{{ asset('storage/' . $recJasa->jasa_banners->first()->image) }}" alt="{{ $recJasa->judul }}">
                            @else
                                <img src="/images/logo-picture.jpg" alt="Default Recommendation">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($recJasa->judul, 30) }}</h5>
                            <p class="card-text">
                                {{ Str::limit($recJasa->deskripsi, 80) }}
                            </p>
                            <small class="text-success fw-bold">Rp {{ number_format($recJasa->harga, 0, ',', '.') }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
            </div>
        </div>
    </div>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>
