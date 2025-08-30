<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatelitJasa - Platform Jasa Terpercaya</title>
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

    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(51, 51, 51, 0.8) 100%), url('/images/satelite-background.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        z-index: 2;
        max-width: 800px;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--primary-white);
        margin-bottom: 2rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: #cccccc;
        margin-bottom: 3rem;
        font-weight: 300;
    }

    .search-container {
        max-width: 600px;
        position: relative;
    }

    .search-input {
        border: none;
        border-radius: 50px;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .search-btn {
        border-radius: 50px;
        padding: 1rem 2rem;
        background: var(--primary-white);
        color: var(--primary-black);
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: var(--soft-gray);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .category-section {
        padding: 5rem 0;
        background: var(--primary-white);
    }

    .category-btn {
        border: 2px solid var(--primary-black);
        color: var(--primary-black);
        background: transparent;
        border-radius: 25px;
        padding: 0.75rem 1.5rem;
        margin: 0.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .category-btn:hover {
        background: var(--primary-black);
        color: var(--primary-white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .services-section {
        padding: 5rem 0;
        background: var(--soft-gray);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 3rem;
        text-align: center;
    }

    .service-card {
        background: var(--primary-white);
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .service-card img {
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .service-card:hover img {
        transform: scale(1.05);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 1rem;
    }

    .card-text {
        color: var(--text-gray);
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

    .dropdown-menu {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 1rem 0;
        margin-top: 0.5rem;
        background: var(--primary-white);
        min-width: 200px;
        backdrop-filter: blur(10px);
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
        position: relative;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background: var(--primary-black) !important;
        color: var(--primary-white) !important;
        transform: translateX(5px);
    }

    .dropdown-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: var(--primary-black);
        transition: height 0.3s ease;
        border-radius: 2px;
    }

    .dropdown-item:hover::before {
        height: 100%;
        background: var(--primary-white);
    }

    .dropdown-divider {
        margin: 0.5rem 1rem;
        border-color: var(--border-gray);
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

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .category-btn {
            display: block;
            margin: 0.5rem 0;
            text-align: center;
        }

        .search-input {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2rem;
        }

        .category-section,
        .services-section {
            padding: 3rem 0;
        }
    }
</style>

<body>
    <x-navbar/>
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center">
                        <h1 class="hero-title">
                            Temukan Jasa Terbaik<br>
                            <span class="text-white-50">untuk Setiap Kebutuhan</span>
                        </h1>
                        <p class="hero-subtitle">
                            Platform terpercaya yang menghubungkan Anda dengan penyedia jasa profesional.
                            Kapanpun, dimanapun, kami siap melayani.
                        </p>

                        <form action="/" method="GET" class="search-container mx-auto">
                            <div class="input-group input-group-lg">
                                <input type="text" name="search" class="form-control search-input"
                                    placeholder="Cari jasa yang Anda butuhkan..." 
                                    aria-label="Search services"
                                    value="{{ request('search') }}">
                                <button class="btn search-btn" type="submit">
                                    <i class="fas fa-search me-2"></i>Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Kategori Populer</h2>
                    <div class="text-center">
                        @foreach ($kategoris as $kategori)
                            <a href="#" class="category-btn">{{ $kategori->nama }}</a>
                        @endforeach
                        <a href="/categories" class="category-btn">Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section" id="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="section-title mb-0">
                                @if(request('search'))
                                    Hasil Pencarian: "{{ request('search') }}"
                                @else
                                    Layanan Unggulan
                                @endif
                            </h2>
                            @if(request('search') && $jasas->total() > 0)
                                <a href="/" class="btn btn-sm btn-outline-secondary mt-2">
                                    <i class="fas fa-times me-1"></i>Hapus Pencarian
                                </a>
                            @endif
                        </div>
                        <small class="text-muted">
                            Menampilkan {{ $jasas->count() }} dari {{ $jasas->total() }} jasa
                        </small>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($jasas as $jasa)
                    <div class="col-lg-4 col-md-6 g-5">
                        <a href="/detail/{{ $jasa->id }}" class="text-decoration-none">
                            <div class="card service-card h-100">
                                <div class="overflow-hidden">
                                    @if($jasa->jasa_banners->isNotEmpty())
                                        <img src="{{ asset('storage/' . $jasa->jasa_banners->first()->image) }}" 
                                             class="card-img-top w-100" 
                                             alt="{{ $jasa->judul }}"
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="/images/logo-picture.jpg" 
                                             class="card-img-top w-100" 
                                             alt="{{ $jasa->judul }}"
                                             style="height: 200px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $jasa->judul }}</h5>
                                    <p class="card-text flex-grow-1">
                                        {{ Str::limit($jasa->deskripsi, 120, '...') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-store me-1"></i>
                                            {{ $jasa->store->nama ?? 'SatelitJasa' }}
                                        </small>
                                        <span class="fw-bold text-primary">Rp {{ number_format($jasa->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada jasa yang tersedia</p>
                    </div>
                @endforelse
            </div>

            @if($jasas->hasPages())
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Service pagination">
                        <ul class="pagination pagination-modern justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($jasas->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jasas->previousPageUrl() }}#services" aria-label="Previous">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($jasas->getUrlRange(1, $jasas->lastPage()) as $page => $url)
                                @if ($page == $jasas->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link" aria-current="page">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}#services">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($jasas->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jasas->nextPageUrl() }}#services" aria-label="Next">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Next">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>