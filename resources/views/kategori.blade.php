<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        max-width: 1200px;
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
    }

    .page-title {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin-bottom: 0;
    }

    .content-card {
        background: var(--primary-white);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow-medium);
        border: 1px solid var(--border-color);
    }

    .content-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .add-category-btn {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-light);
    }

    .add-category-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        color: white;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 1.5rem;
        color: white;
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .table-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--border-color);
    }

    .table {
        margin-bottom: 0;
        background: var(--primary-white);
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
    }

    .table thead th {
        color: white;
        font-weight: 600;
        padding: 1rem;
        border: none;
        text-align: center;
        font-size: 0.95rem;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background: var(--light-gray);
        transition: all 0.3s ease;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .category-id {
        font-weight: 600;
        color: var(--primary-blue);
        background: rgba(22, 83, 126, 0.1);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        display: inline-block;
        min-width: 40px;
    }

    .category-name {
        font-weight: 500;
        color: var(--text-primary);
        font-size: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-edit {
        background: var(--success-color);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
    }

    .btn-edit:hover {
        background: #218838;
        transform: translateY(-1px);
        color: white;
    }

    .btn-delete {
        background: var(--danger-color);
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #c82333;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h4 {
        margin-bottom: 1rem;
        color: var(--text-primary);
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

    @media (max-width: 768px) {
        .page-container {
            padding: 0 0.5rem;
        }
        
        .page-header,
        .content-card {
            padding: 1.5rem;
            border-radius: 15px;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .content-header {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .back-btn {
            position: relative;
            top: 0;
            left: 0;
            margin-bottom: 1rem;
            align-self: flex-start;
        }
    }

    /* Animation untuk tombol delete confirmation */
    .btn-delete.confirming {
        background: var(--warning-color);
        color: var(--text-primary);
    }
</style>

<body>
    <div class="page-container">
        <a href="/" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>

        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-tags"></i>
                Manajemen Kategori
            </h1>
            <p class="page-subtitle">Kelola kategori jasa yang tersedia di platform SatelitJasa</p>
        </div>

        <div class="content-card">
            <div class="content-header">
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-number">{{ $kategori->count() }}</div>
                        <div class="stat-label">Total Kategori</div>
                    </div>
                </div>
                
                <a href="/kategori/tambah" class="add-category-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Kategori Baru
                </a>
            </div>

            @if($kategori->count() > 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th><i class="fas fa-tag me-2"></i>Nama Kategori</th>
                            <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $row)
                            <tr>
                                <td>
                                    <span class="category-id">#{{ $row->id }}</span>
                                </td>
                                <td>
                                    <span class="category-name">{{ $row->nama }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/kategori/edit/{{ $row->id }}" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('kategori.delete', [$row->id]) }}" method="post" 
                                              onsubmit="return confirmDelete('{{ $row->nama }}')" style="display: inline;">
                                            @csrf
                                            @method("delete")
                                            <button type="submit" class="btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-tags"></i>
                <h4>Belum Ada Kategori</h4>
                <p>Mulai dengan menambahkan kategori pertama untuk mengorganisir jasa-jasa yang tersedia.</p>
                <a href="/kategori/tambah" class="add-category-btn">
                    <i class="fas fa-plus"></i>
                    Tambah Kategori Pertama
                </a>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script>
        function confirmDelete(categoryName) {
            return confirm(`Apakah Anda yakin ingin menghapus kategori "${categoryName}"?\n\nTindakan ini tidak dapat dibatalkan.`);
        }

        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('.content-card, .page-header');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate table rows
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-10px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 200 + (index * 50));
            });
        });
    </script>

    <!-- Bootstrap JS for navbar dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
            crossorigin="anonymous"></script>
</body>

</html>