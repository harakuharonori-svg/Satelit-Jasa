<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    :root {
        --primary-black: #000000;
        --primary-white: #ffffff;
        --soft-gray: #f8f9fa;
        --border-gray: #e9ecef;
        --text-gray: #6c757d;
        --hover-gray: #f1f3f4;
        --success-green: #198754;
        --danger-red: #dc3545;
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

    /* Footer Styles - Consistent with other pages */
    footer {
        margin-top: auto;
    }

    /* Responsive Design */
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

<body>
    <!-- Back Button -->
    <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <!-- Main Register Container -->
    <div class="register-container">
        <div class="register-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <img src="/images/logo_black.png" alt="SatelitJasa Logo" class="logo-img">
                <h1 class="welcome-text">Bergabung dengan Kami</h1>
                <p class="welcome-subtitle">Daftar dan mulai temukan jasa terbaik</p>
            </div>

            <!-- Auth Tabs -->
            <div class="auth-tabs">
                <a href="/auth/login" class="auth-tab">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Masuk
                </a>
                <a href="/auth/register" class="auth-tab active">
                    <i class="fas fa-user-plus me-2"></i>
                    Daftar
                </a>
            </div>

            <!-- Register Form -->
            <form id="registerForm" action="{{ route("register.store") }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">
                        <i class="fas fa-user"></i>
                        Nama Lengkap
                    </label>
                    <input type="text" class="form-control-modern" id="username" name="nama"
                        placeholder="Masukkan nama lengkap" value="{{ old("nama") }}">
                    @error("nama")
                        <div style="color: red;">
                            <div style="color: red;">
                                {{$message}}
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Alamat Email
                    </label>
                    <input type="email" class="form-control-modern" id="email" name="email"
                        placeholder="nama@example.com" value="{{ old("email") }}">
                    @error("email")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i>
                        No. Telepon
                    </label>
                    <input type="tel" class="form-control-modern" id="phone" name="telp" placeholder="081234567890"
                        value="{{ old("telp") }}">
                    @error("telp")
                        <div style="color: red;">
                            {{$message}}
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
                            placeholder="Minimal 8 karakter" value="{{ old("password") }}">
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password', 'passwordIcon')">
                            <i class="fas fa-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                    <div class="password-strength" id="passwordStrength">
                        <div class="password-strength-bar"></div>
                    </div>
                    @error("password")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-shield-alt"></i>
                        Konfirmasi Kata Sandi
                    </label>
                    <div class="password-input-group">
                        <input type="password" class="form-control-modern" id="password_confirmation"
                            name="confirmpassword" placeholder="Ulangi kata sandi">
                        <button type="button" class="password-toggle"
                            onclick="togglePassword('password_confirmation', 'passwordConfirmIcon')">
                            <i class="fas fa-eye" id="passwordConfirmIcon"></i>
                        </button>
                    </div>
                    @error("confirmpassword")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="register-btn" id="registerBtn">
                    <i class="fas fa-user-plus me-2"></i>
                    Daftar Sekarang
                </button>

                <div class="login-link">
                    <p>Sudah punya akun?
                        <a href="/auth/login">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            Masuk di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    
    <script>
        // SweetAlert Toast untuk notifikasi sukses register
        @if(session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        // Fungsi untuk toggle password visibility
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            strengthIndicator.className = 'password-strength';
            if (strength > 0 && strength <= 2) {
                strengthIndicator.classList.add('weak');
            } else if (strength > 2 && strength <= 4) {
                strengthIndicator.classList.add('medium');
            } else if (strength > 4) {
                strengthIndicator.classList.add('strong');
            }
        });
    </script>
</body>

</html>