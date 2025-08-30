<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="styl            <!-- Inbox Header -->
            <div class="inbox-header">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h1 class="inbox-title">
                            <i class="fas fa-inbox me-3"></i>
                            Kotak Masuk
                        </h1>
                        <p class="inbox-subtitle">Kelola percakapan dan komunikasi dengan penyedia jasa</p>
                    </div>
                </div>
            </div><style>
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

    
    .inbox-container {
        padding-top: 120px;
        min-height: 100vh;
    }

    .inbox-header {
        background: var(--primary-white);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .inbox-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }

    .inbox-subtitle {
        color: var(--text-gray);
        font-size: 1.1rem;
    }

    .search-container {
        margin-bottom: 2rem;
    }

    .search-input {
        border: 2px solid var(--border-gray);
        border-radius: 50px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--primary-white);
    }

    .search-input:focus {
        border-color: var(--primary-black);
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
        background: var(--primary-white);
    }

    .search-btn {
        background: var(--primary-black);
        border: 2px solid var(--primary-black);
        color: var(--primary-white);
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: var(--primary-white);
        color: var(--primary-black);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .inbox-stats {
        background: var(--primary-white);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-item {
        text-align: center;
        padding: 1rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-black);
        display: block;
    }

    .stat-label {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .conversation-list {
        background: var(--primary-white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .conversation-item {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border-gray);
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .conversation-item:hover {
        background: var(--hover-gray);
        color: inherit;
        text-decoration: none;
        transform: translateX(5px);
    }

    .conversation-item:last-child {
        border-bottom: none;
    }

    .conversation-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 3px solid var(--border-gray);
        transition: all 0.3s ease;
        object-fit: cover;
    }

    .conversation-item:hover .conversation-avatar {
        border-color: var(--primary-black);
        transform: scale(1.05);
    }

    .conversation-content {
        flex: 1;
        min-width: 0;
    }

    .conversation-name {
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--primary-black);
        margin-bottom: 0.25rem;
    }

    .conversation-preview {
        color: var(--text-gray);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .conversation-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .conversation-time {
        color: var(--text-gray);
        font-size: 0.85rem;
    }

    .conversation-badge {
        background: var(--primary-black);
        color: var(--primary-white);
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .conversation-status {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-left: auto;
    }

    .status-online {
        background: #22c55e;
    }

    .status-offline {
        background: var(--text-gray);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-gray);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: var(--border-gray);
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--primary-black);
    }

    .empty-text {
        font-size: 1rem;
    }

    
    .filter-tabs {
        background: var(--primary-white);
        border-radius: 15px;
        padding: 0.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-tab {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: var(--text-gray);
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
    }

    .filter-tab.active,
    .filter-tab:hover {
        background: var(--primary-black);
        color: var(--primary-white);
    }

    
    @media (max-width: 768px) {
        .inbox-container {
            padding-top: 100px;
        }

        .inbox-header {
            padding: 1.5rem;
        }

        .inbox-title {
            font-size: 1.5rem;
        }

        .conversation-item {
            padding: 1rem;
        }

        .conversation-avatar {
            width: 50px;
            height: 50px;
        }

        .stat-item {
            padding: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .search-input,
        .search-btn {
            border-radius: 25px;
            margin-bottom: 0.5rem;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

<body>
    <x-navbar/>

    <div class="inbox-container">
        <div class="container">
    
            <div class="inbox-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="inbox-title">
                            <i class="fas fa-inbox me-3"></i>
                            Kotak Masuk
                        </h1>
                        <p class="inbox-subtitle">Kelola percakapan dan komunikasi dengan penyedia jasa</p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="/chat/new" class="btn btn-dark btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            Pesan Baru
                        </a>
                    </div>
                </div>
            </div>

    
            <div class="search-container">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control search-input" 
                           placeholder="Cari percakapan atau nama kontak..."
                           aria-label="Search conversations">
                    <button class="btn search-btn" type="button">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </div>

    
            <div class="inbox-stats">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">24</span>
                            <div class="stat-label">Total Percakapan</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">5</span>
                            <div class="stat-label">Belum Dibaca</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">12</span>
                            <div class="stat-label">Aktif Hari Ini</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">8</span>
                            <div class="stat-label">Penyedia Jasa</div>
                        </div>
                    </div>
                </div>
            </div>

    
            <div class="filter-tabs d-flex flex-wrap">
                <button class="filter-tab active" data-filter="all">
                    <i class="fas fa-list me-2"></i>Semua
                </button>
                <button class="filter-tab" data-filter="unread">
                    <i class="fas fa-envelope me-2"></i>Belum Dibaca
                </button>
            </div>

    
            <div class="conversation-list">
                <a href="/chat/1" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Ahmad Rizky</div>
                            <div class="conversation-preview">
                                Halo, saya tertarik dengan jasa desain logo yang Anda tawarkan. Bisakah kita diskusi lebih lanjut?
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>2 menit yang lalu
                                </span>
                                <span class="conversation-badge">3</span>
                            </div>
                        </div>
                        <div class="conversation-status status-online"></div>
                    </div>
                </a>

                <a href="/chat/2" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Sari Dewi</div>
                            <div class="conversation-preview">
                                Terima kasih atas layanan pemrograman website yang sangat memuaskan!
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>1 jam yang lalu
                                </span>
                            </div>
                        </div>
                        <div class="conversation-status status-offline"></div>
                    </div>
                </a>

                <a href="/chat/3" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Budi Santoso</div>
                            <div class="conversation-preview">
                                Kapan bisa mulai mengerjakan proyek video editing yang kita bicarakan kemarin?
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>3 jam yang lalu
                                </span>
                                <span class="conversation-badge">1</span>
                            </div>
                        </div>
                        <div class="conversation-status status-online"></div>
                    </div>
                </a>

                <a href="/chat/4" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Linda Maharani</div>
                            <div class="conversation-preview">
                                Apakah ada revisi untuk desain brosur yang sudah saya kirimkan?
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>5 jam yang lalu
                                </span>
                            </div>
                        </div>
                        <div class="conversation-status status-offline"></div>
                    </div>
                </a>

                <a href="/chat/5" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Eko Prasetyo</div>
                            <div class="conversation-preview">
                                Saya butuh bantuan untuk penerjemahan dokumen bisnis, apakah Anda bisa bantu?
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>1 hari yang lalu
                                </span>
                                <span class="conversation-badge">2</span>
                            </div>
                        </div>
                        <div class="conversation-status status-online"></div>
                    </div>
                </a>

                <a href="/chat/6" class="conversation-item">
                    <div class="d-flex align-items-center">
                        <img src="/images/pfp.jpg" alt="Profile" class="conversation-avatar me-3">
                        <div class="conversation-content">
                            <div class="conversation-name">Maya Kusuma</div>
                            <div class="conversation-preview">
                                Hasil fotografi pernikahan sudah selesai diedit dan siap untuk diserahkan.
                            </div>
                            <div class="conversation-meta">
                                <span class="conversation-time">
                                    <i class="fas fa-clock me-1"></i>2 hari yang lalu
                                </span>
                            </div>
                        </div>
                        <div class="conversation-status status-offline"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <x-footer/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // Filter functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Filter logic can be implemented here based on data-filter attribute
                const filter = this.getAttribute('data-filter');
                console.log('Filtering by:', filter);
            });
        });

        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const conversations = document.querySelectorAll('.conversation-item');
            
            conversations.forEach(conversation => {
                const name = conversation.querySelector('.conversation-name').textContent.toLowerCase();
                const preview = conversation.querySelector('.conversation-preview').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || preview.includes(searchTerm)) {
                    conversation.style.display = 'block';
                } else {
                    conversation.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
