<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jasa - SatelitJasa</title>
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

    .edit-jasa-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        position: relative;
        margin-top: 80px;
    }

    .edit-jasa-card {
        background: var(--primary-white);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-gray);
        width: 100%;
        max-width: 700px;
        position: relative;
        overflow: hidden;
        max-height: 90vh;
        overflow-y: auto;
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-header h2 {
        color: var(--primary-black);
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: var(--text-gray);
        margin: 0;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--primary-black);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: var(--text-gray);
    }

    .form-control-modern {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-gray);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--primary-white);
        color: var(--primary-black);
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--primary-black);
        box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
    }

    .kategori-checkboxes {
        max-height: 200px;
        overflow-y: auto;
        border: 2px solid var(--border-gray);
        border-radius: 12px;
        padding: 1rem;
        background: var(--primary-white);
    }

    .form-check {
        margin-bottom: 0.5rem;
    }

    .form-check-input:checked {
        background-color: var(--primary-black);
        border-color: var(--primary-black);
    }

    .current-banners {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .banner-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid var(--border-gray);
    }

    .banner-item img {
        width: 100%;
        height: 100px;
        object-fit: cover;
    }

    .banner-delete {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 0, 0, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .banner-delete:hover {
        background: rgba(255, 0, 0, 1);
    }

    .update-btn {
        width: 100%;
        padding: 1rem;
        background: var(--primary-black);
        color: var(--primary-white);
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .update-btn:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .back-btn {
        position: fixed;
        top: 100px;
        left: 20px;
        background: var(--primary-white);
        color: var(--primary-black);
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        font-weight: 500;
        z-index: 1000;
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: var(--primary-black);
    }

    .back-btn i {
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .edit-jasa-container {
            padding: 1rem;
        }

        .edit-jasa-card {
            padding: 2rem;
        }

        .back-btn {
            position: relative;
            top: 0;
            left: 0;
            margin-bottom: 1rem;
            display: inline-block;
        }
    }
</style>

<body>
    <x-navbar />

    <a href="/detail/{{ $jasa->id }}" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali ke Detail</span>
    </a>

    <div class="edit-jasa-container">
        <div class="edit-jasa-card">
            <div class="form-header">
                <h2>Edit Jasa</h2>
                <p>Perbarui informasi jasa Anda</p>
            </div>

            <form action="/editjasa/{{ $jasa->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul" class="form-label">
                        <i class="fas fa-heading"></i>
                        Judul Jasa
                    </label>
                    <input type="text" class="form-control-modern" id="judul" name="judul"
                        placeholder="Masukkan Judul Jasa" value="{{ old('judul', $jasa->judul) }}" required>
                    @error("judul")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi Jasa
                    </label>
                    <textarea class="form-control-modern" id="deskripsi" name="deskripsi" rows="4"
                        placeholder="Jelaskan detail jasa yang Anda tawarkan..." required>{{ old('deskripsi', $jasa->deskripsi) }}</textarea>
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
                        placeholder="Masukkan Harga Jasa" value="{{ old('harga', $jasa->harga) }}" min="1000" required>
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
                                       {{ in_array($kategori->id, old('kategoris', $jasa->kategoris->pluck('id')->toArray())) ? 'checked' : '' }}>
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

                @if($jasa->jasa_banners->count() > 0)
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-images"></i>
                        Banner Saat Ini
                    </label>
                    <div class="current-banners">
                        @foreach($jasa->jasa_banners as $banner)
                            <div class="banner-item" id="banner-{{ $banner->id }}">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner">
                                <button type="button" class="banner-delete" onclick="deleteBanner({{ $banner->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="banners" class="form-label">
                        <i class="fas fa-image"></i>
                        Tambah Banner Baru (Opsional)
                    </label>
                    <input type="file" class="form-control-modern form-control" id="banners" name="banners[]" 
                           accept=".jpg,.jpeg,.png" multiple>
                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB per file. Bisa upload beberapa banner.</small>
                    @error("banners")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                    @error("banners.*")
                        <div style="color: red;">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="update-btn" id="submitBtn">
                    <i class="fas fa-save me-2"></i>
                    Perbarui Jasa
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteBanner(bannerId) {
            Swal.fire({
                title: 'Hapus Banner?',
                text: "Banner yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/editjasa/banner/${bannerId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`banner-${bannerId}`).remove();
                            Swal.fire('Terhapus!', 'Banner berhasil dihapus.', 'success');
                        } else {
                            Swal.fire('Error!', 'Gagal menghapus banner.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Terjadi kesalahan.', 'error');
                    });
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
</body>

</html>
