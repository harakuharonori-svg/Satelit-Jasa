<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SatelitJasa</title>
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
        background: linear-gradient(135deg, var(--soft-gray) 0%, var(--primary-white) 100%);
        min-height: 100vh;
    }

    .login-container {
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

    .login-card {
        background: var(--primary-white);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-gray);
        width: 100%;
        max-width: 450px;
        position: relative;
        overflow: hidden;
    }

    .login-card::before {
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
        width: 80px;
        height: 80px;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .logo-img:hover {
        transform: scale(1.05);
    }

    .welcome-text {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        color: var(--text-gray);
        font-size: 1rem;
        margin-bottom: 2rem;
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
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control-modern {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid var(--border-gray);
        border-radius: 15px;
        font-size: 1rem;
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

    .login-btn {
        width: 100%;
        background: var(--primary-black);
        border: 2px solid var(--primary-black);
        color: var(--primary-white);
        padding: 1rem 2rem;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .login-btn:hover {
        background: transparent;
        color: var(--primary-black);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .forgot-password {
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .forgot-password a {
        color: var(--text-gray);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .forgot-password a:hover {
        color: var(--primary-black);
    }

    .forgot-password a::after {
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

    .forgot-password a:hover::after {
        width: 100%;
    }

    /* Footer Styles - Consistent with other pages */
    footer {
        margin-top: auto;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-container {
            padding: 1rem;
        }

        .back-btn {
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
        }

        .login-card {
            padding: 2rem;
            border-radius: 20px;
        }

        .welcome-text {
            font-size: 1.5rem;
        }

        .logo-img {
            width: 60px;
            height: 60px;
        }
    }

    @media (max-width: 576px) {
        .back-btn span {
            display: none;
        }

        .login-card {
            padding: 1.5rem;
            border-radius: 15px;
        }

        .auth-tabs {
            margin-bottom: 1.5rem;
        }

        .form-control-modern {
            padding: 0.875rem 1.25rem;
        }
    }

    /* Loading state for button */
    .login-btn.loading {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .login-btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
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
</style>

<body>

    <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>


    <div class="login-container">
        <div class="login-card">

            <div class="logo-section">
                <img src="/images/logo_black.png" alt="SatelitJasa Logo" class="logo-img">
                <h1 class="welcome-text">Selamat Datang</h1>
                <p class="welcome-subtitle">Masuk ke akun SatelitJasa Anda</p>
            </div>


            <div class="auth-tabs">
                <a href="/auth/login" class="auth-tab active">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk
                </a>


                <a href="/auth/register" class="auth-tab">
                    <i class="fas fa-user-plus me-2"></i>
                    Daftar
                </a>
            </div>


            <form id="loginForm" action="{{ route("login.post") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Alamat Email
                    </label>
                    <input type="text" class="form-control-modern" id="email" name="email"
                        placeholder="nama@example.com" required value="{{ old("email") }}">
                    @error("email")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Kata Sandi
                    </label>
                    <div class="password-input-group">
                        <input type="password" class="form-control-modern" id="password" name="password"
                            placeholder="Masukkan kata sandi" required>
                        @error("password")
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk ke Akun
                </button>

                <div class="forgot-password">
                    <a href="/auth/forgot-password">
                        <i class="fas fa-question-circle me-1"></i>
                        Lupa kata sandi?
                    </a>
                </div>
            </form>
        </div>
    </div>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function (e) {
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.classList.add('loading');
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Masuk...';

            setTimeout(() => {
                loginBtn.classList.remove('loading');
                loginBtn.innerHTML = '<i class="fas fa-sign-in-alt me-2"></i>Masuk ke Akun';
            }, 2000);
        });

        const inputs = document.querySelectorAll('.form-control-modern');
        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (this.value.trim() === '') {
                    this.style.borderColor = '#dc3545';
                } else if (this.type === 'email' && !isValidEmail(this.value)) {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = '#198754';
                }
            });

            input.addEventListener('focus', function () {
                this.style.borderColor = 'var(--primary-black)';
            });
        });

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
</body>

</html>