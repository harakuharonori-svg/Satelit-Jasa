<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .tambah-jasa-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
    }

    .tambah-jasa-card {
        background: var(--primary-white);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-gray);
        width: 100%;
        max-width: 600px;
        position: relative;
        overflow: hidden;
        max-height: 90vh;
        overflow-y: auto;
    }

    @media (max-width: 768px) {
        .tambah-jasa-container {
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

    <div style="margin-top: 100px;" class="tambah-jasa-container">
        <div class="tambah-jasa-card">
            <div class="logo-section">
                <img src="/images/logo_black.png" alt="SatelitJasa Logo" class="logo-img">
                <h1 class="welcome-text">Buat Halaman Jasamu</h1>
            </div>


            <form action="{{ route('jasa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="judul" class="form-label">
                        <i class="fas fa-hashtag"></i>
                        Judul Jasa
                    </label>
                    <input type="text" class="form-control-modern" id="judul" name="judul"
                        placeholder="Masukkan Judul Jasa" value="{{ old('judul') }}">
                    @error("judul")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi
                    </label>
                    <textarea class="form-control-modern" id="deskripsi" name="deskripsi" rows="4"
                        placeholder="Masukkan deskripsi jasa Anda secara detail">{{ old('deskripsi') }}</textarea>
                    @error("deskripsi")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga" class="form-label">
                        <i class="fas fa-money-bill-wave"></i>
                        Harga Jasa (Rp)
                    </label>
                    <input type="number" class="form-control-modern" id="harga" name="harga"
                        placeholder="Masukkan Harga Jasa" value="{{ old('harga') }}" min="1000">
                    @error("harga")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategoris" class="form-label">
                        <i class="fas fa-tags"></i>
                        Kategori Jasa
                    </label>
                    <div class="kategori-checkboxes">
                        @foreach($kategoris as $kategori)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="kategoris[]" 
                                       value="{{ $kategori->id }}" id="kategori{{ $kategori->id }}"
                                       {{ in_array($kategori->id, old('kategoris', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="kategori{{ $kategori->id }}">
                                    {{ $kategori->nama }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Pilih minimal 1 kategori yang sesuai dengan jasa Anda.</small>
                    @error("kategoris")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="banner" class="form-label">
                        <i class="fas fa-image"></i>
                        Banner Jasa
                    </label>
                    <input type="file" class="form-control-modern form-control" id="banner" name="banner[]" 
                           accept=".jpg,.jpeg,.png" multiple>
                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB per file. Bisa upload beberapa banner.</small>
                    @error("banner")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                    @error("banner.*")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="register-btn" id="submitBtn">
                    <i class="fas fa-plus me-2"></i>
                    Buat Jasa
                </button>
            </form>
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <!-- SweetAlert Notifications -->
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

    <!-- Banner Preview Script -->
    <script>
        document.getElementById('banner').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('bannerPreview');
            
            if (!preview) {
                const previewDiv = document.createElement('div');
                previewDiv.id = 'bannerPreview';
                previewDiv.className = 'mt-3';
                previewDiv.innerHTML = '<strong>Preview Banner:</strong>';
                e.target.parentNode.appendChild(previewDiv);
            }
            
            const existingPreviews = document.querySelectorAll('.banner-preview-img');
            existingPreviews.forEach(img => img.remove());
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'banner-preview-img';
                        img.style.cssText = 'width: 100px; height: 60px; object-fit: cover; margin: 5px; border-radius: 8px; border: 2px solid #ddd;';
                        document.getElementById('bannerPreview').appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
</body>

</html>