<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Gagal - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2980b9;
            --light-blue: #ebf4f8;
            --error-red: #e74c3c;
            --text-dark: #2c3e50;
            --text-gray: #7f8c8d;
        }
        body {
            background: linear-gradient(135deg, #fdf2f2 0%, #fff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .error-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(231, 76, 60, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .error-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--error-red), #c0392b);
        }
        .error-icon {
            width: 100px;
            height: 100px;
            background: var(--error-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: errorShake 1s ease-in-out;
        }
        .error-icon i {
            color: white;
            font-size: 3rem;
        }
        @keyframes errorShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .error-title {
            color: var(--text-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .error-subtitle {
            color: var(--text-gray);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-details {
            background: #fdf2f2;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(231, 76, 60, 0.1);
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: var(--text-gray);
            font-weight: 500;
        }
        .detail-value {
            color: var(--text-dark);
            font-weight: 600;
        }
        .error-reasons {
            background: #fff5f5;
            border-left: 4px solid var(--error-red);
            border-radius: 0 15px 15px 0;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }
        .error-reasons h5 {
            color: var(--error-red);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .error-reasons ul {
            margin-bottom: 0;
            padding-left: 1.5rem;
        }
        .error-reasons li {
            color: var(--text-gray);
            margin-bottom: 0.5rem;
        }
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }
        .btn-primary-custom {
            background: var(--primary-blue);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-primary-custom:hover {
            background: #1abc9c;
            transform: translateY(-2px);
            color: white;
        }
        .btn-secondary-custom {
            background: transparent;
            border: 2px solid var(--error-red);
            color: var(--error-red);
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-secondary-custom:hover {
            background: var(--error-red);
            color: white;
        }
        .help-section {
            background: var(--light-blue);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }
        .help-section h5 {
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        .help-section p {
            color: var(--text-gray);
            margin-bottom: 0;
        }
        @media (max-width: 768px) {
            .error-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            .error-title {
                font-size: 1.5rem;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fas fa-times"></i>
            </div>
            <h1 class="error-title">Pembayaran Gagal!</h1>
            <p class="error-subtitle">
                Maaf, terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi atau hubungi customer service jika masalah berlanjut.
            </p>
            @if(isset($transaksi))
            <div class="error-details">
                <div class="detail-row">
                    <span class="detail-label">ID Transaksi</span>
                    <span class="detail-value">#{{ $transaksi->external_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Jasa</span>
                    <span class="detail-value">{{ $transaksi->jasa->judul }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Pembayaran</span>
                    <span class="detail-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Metode Pembayaran</span>
                    <span class="detail-value">{{ strtoupper($transaksi->payment_method) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status</span>
                    <span class="detail-value">
                        <span class="text-danger">{{ ucfirst($transaksi->payment_status) }}</span>
                    </span>
                </div>
            </div>
            @endif
            <div class="error-reasons">
                <h5><i class="fas fa-exclamation-triangle me-2"></i>Kemungkinan Penyebab:</h5>
                <ul>
                    <li>Koneksi internet tidak stabil</li>
                    <li>Saldo rekening tidak mencukupi</li>
                    <li>Terjadi gangguan pada sistem pembayaran</li>
                    <li>Batas waktu pembayaran telah habis</li>
                    <li>Informasi pembayaran tidak valid</li>
                </ul>
            </div>
            <div class="help-section">
                <h5><i class="fas fa-life-ring me-2"></i>Butuh Bantuan?</h5>
                <p>
                    Jika Anda mengalami masalah berulang, silakan hubungi customer service kami di 
                    <strong>support@satelitjasa.com</strong> atau melalui WhatsApp di 
                    <strong>+62 812-3456-7890</strong>. Tim kami siap membantu Anda 24/7.
                </p>
            </div>
            <div class="action-buttons">
                @if(isset($transaksi))
                <a href="{{ route('pembayaran', $transaksi->id_jasa) }}" class="btn-secondary-custom">
                    <i class="fas fa-redo me-2"></i>Coba Lagi
                </a>
                @endif
                <a href="/" class="btn-primary-custom">
                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
