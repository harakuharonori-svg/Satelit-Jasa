<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    :root {
        --primary-blue: #16537e;
        --accent-blue: #1abc9c;
        --primary-white: #ffffff;
        --light-gray: #f8f9fa;
        --border-color: #e9ecef;
        --text-primary: #2c3e50;
        --text-secondary: #6c757d;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 5px 25px rgba(0, 0, 0, 0.15);
    }

    * {
        font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .page-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .page-header {
        background: var(--primary-white);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-color);
        text-align: center;
    }

    .page-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .form-card {
        background: var(--primary-white);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--light-gray);
    }

    .form-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 2rem;
    }

    .form-title {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .form-description {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.75rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control {
        border: 2px solid var(--border-color);
        border-radius: 15px;
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--primary-white);
    }

    .form-control:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(22, 83, 126, 0.25);
        background: var(--primary-white);
    }

    .form-control:valid {
        border-color: var(--success-color);
    }

    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        z-index: 5;
    }

    .form-control.with-icon {
        padding-left: 3rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .btn-save {
        background: linear-gradient(135deg, var(--success-color), #20c997);
        border: none;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-light);
        min-width: 150px;
        justify-content: center;
    }

    .btn-save:hover {
        background: linear-gradient(135deg, #218838, #1ea47a);
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        color: white;
    }

    .btn-save:disabled {
        background: var(--border-color);
        color: var(--text-secondary);
        cursor: not-allowed;
        transform: none;
    }

    .btn-cancel {
        background: transparent;
        border: 2px solid var(--primary-blue);
        color: var(--primary-blue);
        padding: 0.875rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 150px;
        justify-content: center;
    }

    .btn-cancel:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
    }

    .back-btn {
        position: fixed;
        top: 2rem;
        left: 2rem;
        background: var(--primary-white);
        color: var(--primary-blue);
        border: 2px solid var(--primary-blue);
        padding: 0.75rem 1rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-light);
        z-index: 1000;
    }

    .back-btn:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
    }

    .validation-feedback {
        display: block;
        width: 100%;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: var(--danger-color);
    }

    .character-count {
        font-size: 0.8rem;
        color: var(--text-secondary);
        text-align: right;
        margin-top: 0.5rem;
    }

    .character-count.warning {
        color: var(--warning-color);
    }

    .character-count.danger {
        color: var(--danger-color);
    }

    .tips-section {
        background: var(--light-gray);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--accent-blue);
    }

    .tips-title {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tips-list li {
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .tips-list li i {
        color: var(--accent-blue);
        margin-top: 0.2rem;
    }

    @media (max-width: 768px) {
        .page-container {
            padding: 0 0.5rem;
        }
        
        .page-header,
        .form-card {
            padding: 1.5rem;
            border-radius: 15px;
        }
        
        .page-title {
            font-size: 2rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-save,
        .btn-cancel {
            width: 100%;
        }
        
        .back-btn {
            position: relative;
            top: 0;
            left: 0;
            margin-bottom: 1rem;
            align-self: flex-start;
        }
    }

    /* Loading animation */
    .loading {
        position: relative;
        overflow: hidden;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }
</style>

<body>
    <div class="page-container">
        <a href="/kategori" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Kategori</span>
        </a>

        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-plus-circle"></i>
                Tambah Kategori
            </h1>
            <p class="page-subtitle">Buat kategori baru untuk mengorganisir jasa-jasa yang tersedia</p>
        </div>

        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <h2 class="form-title">Kategori Baru</h2>
                <p class="form-description">Tambahkan kategori untuk mengelompokkan jasa yang serupa</p>
            </div>

            <div class="tips-section">
                <div class="tips-title">
                    <i class="fas fa-lightbulb"></i>
                    Tips Penamaan Kategori
                </div>
                <ul class="tips-list">
                    <li>
                        <i class="fas fa-check-circle"></i>
                        Gunakan nama yang singkat dan mudah dipahami
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        Minimal 3 karakter, maksimal 50 karakter
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        Hindari penggunaan karakter khusus berlebihan
                    </li>
                    <li>
                        <i class="fas fa-check-circle"></i>
                        Contoh: "Teknologi", "Desain Grafis", "Konsultasi Bisnis"
                    </li>
                </ul>
            </div>

            <form action="{{ route('kategori.store') }}" method="POST" id="addForm">
                @csrf
                
                <div class="form-group">
                    <label for="categoryName" class="form-label">
                        <i class="fas fa-tag"></i>
                        Nama Kategori
                    </label>
                    <div class="input-group">
                        <i class="fas fa-tag input-icon"></i>
                        <input 
                            type="text" 
                            class="form-control with-icon" 
                            id="categoryName" 
                            name="nama" 
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama kategori baru..."
                            required
                            maxlength="50"
                            oninput="validateInput(this)"
                        >
                    </div>
                    <div class="character-count" id="charCount">
                        <span id="currentCount">0</span>/50 karakter
                    </div>
                    <div class="validation-feedback" id="validationFeedback"></div>
                    @error("nama")
                        <div class="validation-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="action-buttons">
                    <a href="/kategori" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-save" id="saveBtn">
                        <i class="fas fa-plus-circle"></i>
                        <span class="btn-text">Tambah Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLlvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script>
        function validateInput(input) {
            const charCount = document.getElementById('charCount');
            const currentCount = document.getElementById('currentCount');
            const validationFeedback = document.getElementById('validationFeedback');
            const saveBtn = document.getElementById('saveBtn');
            
            const length = input.value.length;
            const maxLength = 50;
            
            // Update character count
            currentCount.textContent = length;
            
            // Update character count styling
            charCount.classList.remove('warning', 'danger');
            if (length > maxLength * 0.8) {
                charCount.classList.add('warning');
            }
            if (length > maxLength * 0.95) {
                charCount.classList.add('danger');
            }
            
            // Validate input
            let isValid = true;
            let errorMessage = '';
            
            if (length === 0) {
                isValid = false;
                errorMessage = 'Nama kategori tidak boleh kosong';
            } else if (length < 3) {
                isValid = false;
                errorMessage = 'Nama kategori minimal 3 karakter';
            } else if (length > maxLength) {
                isValid = false;
                errorMessage = `Nama kategori maksimal ${maxLength} karakter`;
            } else if (!/^[a-zA-Z0-9\s\-_&]+$/.test(input.value)) {
                isValid = false;
                errorMessage = 'Nama kategori hanya boleh mengandung huruf, angka, spasi, dan karakter - _ &';
            }
            
            // Update validation feedback
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                validationFeedback.textContent = '';
                saveBtn.disabled = false;
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                validationFeedback.textContent = errorMessage;
                saveBtn.disabled = true;
            }
        }

        // Form submission with loading state
        document.getElementById('addForm').addEventListener('submit', function(e) {
            const saveBtn = document.getElementById('saveBtn');
            const btnText = saveBtn.querySelector('.btn-text');
            
            saveBtn.disabled = true;
            saveBtn.classList.add('loading');
            btnText.textContent = 'Menambahkan...';
            
            // Add loading animation to form card
            document.querySelector('.form-card').classList.add('loading');
        });

        // Auto-focus on input
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('categoryName');
            input.focus();
            
            // Update character count for old value
            if (input.value) {
                validateInput(input);
            }
            
            // Animate form elements
            const elements = document.querySelectorAll('.page-header, .form-card');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.5s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Prevent form submission with Enter key if validation fails
        document.getElementById('categoryName').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (!document.getElementById('saveBtn').disabled) {
                    document.getElementById('addForm').submit();
                }
            }
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
    @endif

    <!-- Bootstrap JS for navbar dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"></script>
</body>

</html>
