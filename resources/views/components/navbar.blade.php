<div>
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

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .back-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background: var(--primary-white);
            border: 2px solid var(--border-gray);
            color: var(--primary-black);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .back-btn:hover {
            background: var(--primary-black);
            color: var(--primary-white);
            border-color: var(--primary-black);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .register-card {
            background: var(--primary-white);
            border-radius: 25px;
            padding: 3rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-gray);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.02) 0%, transparent 70%);
            pointer-events: none;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        .logo-img {
            width: 70px;
            height: 70px;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .logo-img:hover {
            transform: scale(1.05);
        }

        .welcome-text {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary-black);
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            color: var(--text-gray);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .auth-tabs {
            background: var(--soft-gray);
            border-radius: 15px;
            padding: 0.5rem;
            margin-bottom: 2rem;
            display: flex;
            position: relative;
            z-index: 2;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            color: var(--text-gray);
        }

        .auth-tab.active {
            background: var(--primary-black);
            color: var(--primary-white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .auth-tab:hover:not(.active) {
            background: var(--hover-gray);
            color: var(--primary-black);
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
            z-index: 2;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-black);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control-modern {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border: 2px solid var(--border-gray);
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--primary-white);
            font-family: inherit;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary-black);
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
            background: var(--primary-white);
        }

        .form-control-modern::placeholder {
            color: var(--text-gray);
            opacity: 0.7;
        }

        .form-control-modern.valid {
            border-color: var(--success-green);
        }

        .form-control-modern.invalid {
            border-color: var(--danger-red);
        }

        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-gray);
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-black);
        }

        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            background: var(--border-gray);
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .password-strength.weak .password-strength-bar {
            width: 33%;
            background: var(--danger-red);
        }

        .password-strength.medium .password-strength-bar {
            width: 66%;
            background: #ffc107;
        }

        .password-strength.strong .password-strength-bar {
            width: 100%;
            background: var(--success-green);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .register-btn {
            width: 100%;
            background: var(--primary-black);
            border: 2px solid var(--primary-black);
            color: var(--primary-white);
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .register-btn:hover {
            background: transparent;
            color: var(--primary-black);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .terms-check {
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }

        .terms-check input[type="checkbox"] {
            margin-right: 0.75rem;
            transform: scale(1.1);
        }

        .terms-check label {
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .terms-check a {
            color: var(--primary-black);
            text-decoration: none;
            font-weight: 500;
        }

        .terms-check a:hover {
            text-decoration: underline;
        }

        .login-link {
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .login-link a {
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-link a:hover {
            color: var(--primary-black);
        }

        .login-link a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 50%;
            background-color: var(--primary-black);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .login-link a:hover::after {
            width: 100%;
        }

        @media (max-width: 768px) {
            .register-container {
                padding: 1rem;
            }

            .back-btn {
                top: 1rem;
                left: 1rem;
                padding: 0.5rem 1rem;
            }

            .register-card {
                padding: 2rem;
                border-radius: 20px;
                max-height: 95vh;
            }

            .welcome-text {
                font-size: 1.4rem;
            }

            .logo-img {
                width: 60px;
                height: 60px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 576px) {
            .back-btn span {
                display: none;
            }

            .register-card {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .auth-tabs {
                margin-bottom: 1.5rem;
            }

            .form-control-modern {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }

        /* Loading state for button */
        .register-btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .register-btn.loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: translateY(-50%) rotate(0deg);
            }

            100% {
                transform: translateY(-50%) rotate(360deg);
            }
        }

        /* Validation messages */
        .form-feedback {
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .form-feedback.show {
            display: block;
        }

        .form-feedback.valid {
            color: var(--success-green);
        }

        .form-feedback.invalid {
            color: var(--danger-red);
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-modern fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo_black.png" alt="SatelitJasa Logo" width="40" height="40">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'ADMIN')
                            <li class="nav-item">
                                <a class="nav-link" href="/kategori/tambah">Tambah Kategori</a>
                            </li>
                        @endif
                    @endauth
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Akun
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/auth/register">
                                        <i class="fas fa-user-plus dropdown-item-icon"></i>
                                        Daftar Akun
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/auth/login">
                                        <i class="fas fa-sign-in-alt dropdown-item-icon"></i>
                                        Masuk
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown ms-3">
                            <a href="#" class="nav-link dropdown-toggle p-0" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @php
                                    $userName = Auth::user()->nama ?? 'User';
                                    $avatarUrl = Auth::user()->avatar 
                                        ? asset('storage/' . Auth::user()->avatar)
                                        : "https://ui-avatars.com/api/?name=" . urlencode($userName) 
                                          . "&size=40&background=000000&color=ffffff&bold=true&format=png";
                                @endphp
                                <img src="{{ $avatarUrl }}" alt="Profile" class="rounded-circle profile-img">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->role === 'ADMIN')
                                    <!-- Menu untuk Admin -->
                                    <li>
                                        <a class="dropdown-item" href="/profil/">
                                            <i class="fas fa-user dropdown-item-icon"></i>
                                            Profil Saya
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/kategori">
                                            <i class="fas fa-list dropdown-item-icon"></i>
                                            Kelola Kategori
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.withdrawals.index') }}">
                                            <i class="fas fa-money-check-alt dropdown-item-icon"></i>
                                            Kelola Penarikan
                                        </a>
                                    </li>
                                @else
                                    <!-- Menu untuk User/Freelancer -->
                                    <li>
                                        <a class="dropdown-item" href="/profil/">
                                            <i class="fas fa-user dropdown-item-icon"></i>
                                            Profil Saya
                                        </a>
                                    </li>
                                    @php
                                        $userHasStore = Auth::check() && \App\Models\Store::where('id_user', Auth::id())->exists();
                                    @endphp
                                    
                                    <!-- My Orders (untuk semua user yang login, bukan admin) -->
                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                                            <i class="fas fa-shopping-bag dropdown-item-icon"></i>
                                            Pesanan Saya
                                        </a>
                                    </li>
                                    
                                    @if($userHasStore)
                                        <!-- Freelancer Orders (untuk user yang punya toko) -->
                                        <li>
                                            <a class="dropdown-item" href="{{ route('freelancer.orders.index') }}">
                                                <i class="fas fa-inbox dropdown-item-icon"></i>
                                                Pesanan Masuk
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="/toko">
                                                <i class="fas fa-store dropdown-item-icon"></i>
                                                Toko Saya
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('withdrawal.index') }}">
                                                <i class="fas fa-money-bill-wave dropdown-item-icon"></i>
                                                Penarikan Dana
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="/buattoko">
                                                <i class="fas fa-plus-circle dropdown-item-icon"></i>
                                                Buat Toko
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt dropdown-item-icon"></i>
                                        Keluar
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="/auth/logout" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>