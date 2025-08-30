<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .tambah-toko-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
    }

    .tambah-toko-card {
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

    @media (max-width: 768px) {
        .tambah-toko-container {
            padding: 1rem;
        }
    }
</style>

<body>
    <x-navbar />

    <a href="/" style="margin-top: 100px;" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Beranda</span>
    </a>

    <div style="margin-top: 100px;" class="tambah-toko-container">
        <div class="tambah-toko-card">
            <div class="logo-section">
                <img src="/images/logo_black.png" alt="SatelitJasa Logo" class="logo-img">
                <h1 class="welcome-text">Buat Halaman Jasamu</h1>
            </div>


            <form action="{{ route("toko.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama" class="form-label">
                        <i class="fas fa-hashtag"></i>
                        Nama Toko
                    </label>
                    <input type="text" class="form-control-modern" id="nama" name="nama"
                        placeholder="Masukkan Nama Toko" value="{{ old("nama") }}">
                    @error("nama")
                        <div style="color: red;">
                            <div style="color: red;">
                                {{$message}}
                            </div>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi
                    </label>
                    <textarea class="form-control-modern" id="deskripsi" name="deskripsi" rows="4"
                        placeholder="Masukkan deskripsi toko Anda">{{ old("deskripsi") }}</textarea>
                    @error("deskripsi")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ktp" class="form-label">
                        <i class="fas fa-id-card"></i>
                        Foto KTP
                    </label>
                    <input type="file" class="form-control-modern form-control" id="ktp" name="ktp" 
                           accept=".jpg,.jpeg,.png,.pdf">
                    <small class="text-muted">Format: JPG, PNG, PDF. Maksimal 2MB</small>
                    @error("ktp")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="register-btn" id="registerBtn">
                    <i class="fas fa-arrow-right me-2"></i>
                    Daftar Toko
                </button>
            </form>
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

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