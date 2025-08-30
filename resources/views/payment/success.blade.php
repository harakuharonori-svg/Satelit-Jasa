<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - SatelitJasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #2980b9;
            --light-blue: #ebf4f8;
            --success-green: #27ae60;
            --text-dark: #2c3e50;
            --text-gray: #7f8c8d;
        }
        body {
            background: linear-gradient(135deg, var(--light-blue) 0%, #fff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .success-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(41, 128, 185, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-blue), var(--success-green));
        }
        .success-icon {
            width: 100px;
            height: 100px;
            background: var(--success-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            animation: successPulse 2s infinite;
        }
        .success-icon i {
            color: white;
            font-size: 3rem;
        }
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .success-title {
            color: var(--text-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .success-subtitle {
            color: var(--text-gray);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .payment-details {
            background: var(--light-blue);
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
            border-bottom: 1px solid rgba(41, 128, 185, 0.1);
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
        .qr-code-section {
            background: white;
            border: 2px dashed var(--primary-blue);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }
        .va-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
        }
        .va-number {
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-blue);
            background: white;
            padding: 1rem;
            border-radius: 10px;
            letter-spacing: 2px;
            margin: 1rem 0;
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
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-secondary-custom:hover {
            background: var(--primary-blue);
            color: white;
        }
        .countdown {
            color: #e74c3c;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1rem;
        }
        @media (max-width: 768px) {
            .success-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            .success-title {
                font-size: 1.5rem;
            }
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h1 class="success-title">Pembayaran Berhasil Dibuat!</h1>
            <p class="success-subtitle">
                @if(isset($transaksi) && $transaksi)
                    Pesanan Anda telah berhasil dibuat. Silakan lakukan pembayaran sesuai instruksi di bawah ini.
                @else
                    Terima kasih! Pembayaran Anda sedang diproses.
                @endif
            </p>
            @if(isset($transaksi) && $transaksi)
            <div class="payment-details">
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
                        @if($transaksi->payment_status === 'paid')
                            <span class="text-success">Sudah Dibayar</span>
                        @elseif($transaksi->payment_status === 'pending')
                            <span class="text-warning">Menunggu Pembayaran</span>
                        @else
                            <span class="text-danger">{{ ucfirst($transaksi->payment_status) }}</span>
                        @endif
                    </span>
                </div>
            </div>
            @if($transaksi->payment_method === 'qris' && isset($transaksi->payment_data['qr_string']))
            <div class="qr-code-section">
                <h5 class="mb-3"><i class="fas fa-qrcode me-2"></i>Scan QR Code untuk Membayar</h5>
                <div id="qrcode" class="mb-3"></div>
                <p class="text-muted small">Scan QR code di atas menggunakan aplikasi mobile banking atau e-wallet Anda</p>
            </div>
            @endif
            @if(in_array($transaksi->payment_method, ['bca', 'bni', 'bri', 'cimb']) && $transaksi->payment_reference)
            <div class="va-section">
                <h5 class="mb-3">
                    @php
                        $logoMapping = [
                            'bca' => 'lg-bca.png',
                            'bri' => 'Logo-BRI.png', 
                            'bni' => 'LogoBNI.png',
                            'cimb' => 'logo-niaga.png'
                        ];
                        $logoFile = $logoMapping[$transaksi->payment_method] ?? 'logo-niaga.png';
                    @endphp
                    <img src="{{ asset('images/' . $logoFile) }}" 
                         alt="{{ strtoupper($transaksi->payment_method) }}" 
                         style="height: 30px; margin-right: 10px;">
                    Virtual Account {{ strtoupper($transaksi->payment_method) }}
                </h5>
                <p class="text-muted">Transfer ke nomor Virtual Account berikut:</p>
                <div class="va-number">{{ $transaksi->payment_reference }}</div>
                <p class="text-muted small">
                    Silakan transfer tepat sebesar <strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong>
                    ke nomor Virtual Account di atas melalui ATM, Internet Banking, atau Mobile Banking {{ strtoupper($transaksi->payment_method) }}.
                </p>
            </div>
            @endif
            @if($transaksi->expired_at)
            <div class="countdown">
                Batas waktu pembayaran: <span id="countdown-timer"></span>
            </div>
            @endif
            @else
            <div class="payment-info-card">
                <h3 style="color: var(--primary-blue); margin-bottom: 1rem;">
                    <i class="fas fa-info-circle me-2"></i>Informasi Pembayaran
                </h3>
                <p style="color: var(--text-gray); margin-bottom: 1.5rem;">
                    Pembayaran Anda sedang diproses. Silakan tunggu konfirmasi selanjutnya.
                </p>
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">
                        <span class="text-warning">Menunggu Konfirmasi</span>
                    </span>
                </div>
            </div>
            @endif
            @if(config('app.env') === 'local' || config('app.env') === 'development')
            <div style="background: #fff3cd; border: 2px dashed #ffc107; border-radius: 15px; padding: 1.5rem; margin: 2rem 0;">
                <h6 style="color: #856404; margin-bottom: 1rem;">
                    <i class="fas fa-code me-2"></i>Simulasi Pembayaran (Development Only)
                </h6>
                @if(isset($transaksi) && $transaksi && $transaksi->payment_status === 'pending')
                <button onclick="simulateXenditPayment('PAID')" class="btn" style="background: #28a745; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 500;">
                    <i class="fas fa-check me-1"></i>Simulasi Pembayaran Berhasil
                </button>
                @endif
            </div>
            @endif
            <div style="background: #e7f3ff; border: 2px solid #007bff; border-radius: 15px; padding: 1.5rem; margin: 2rem 0;">
                <h6 style="color: #0056b3; margin-bottom: 1rem;">
                    <i class="fas fa-shield-alt me-2"></i>Verifikasi Status Pembayaran
                </h6>
                <button onclick="verifyPaymentStatus()" class="btn" style="background: #007bff; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; cursor: pointer; font-weight: 500;">
                    <i class="fas fa-sync me-1"></i>Verify & Update Status
                </button>
            </div>
            <div class="action-buttons">
                <a href="{{ route('pembayaran', $transaksi->id_jasa ?? 1) }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Pembayaran
                </a>
                <a href="/" class="btn-primary-custom">
                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if(isset($transaksi) && $transaksi->payment_method === 'qris' && isset($transaksi->payment_data['qr_string']))
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
    <script>
        QRCode.toCanvas(document.getElementById('qrcode'), '{{ $transaksi->payment_data["qr_string"] }}', {
            width: 256,
            margin: 2,
            color: {
                dark: '#2980b9',
                light: '#ffffff'
            }
        });
    </script>
    @endif
    @if(isset($transaksi) && $transaksi->expired_at)
    <script>
        function updateCountdown() {
            const expiredAt = new Date('{{ $transaksi->expired_at->toISOString() }}').getTime();
            const now = new Date().getTime();
            const distance = expiredAt - now;
            if (distance > 0) {
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById('countdown-timer').innerHTML = 
                    `${hours}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            } else {
                document.getElementById('countdown-timer').innerHTML = 'EXPIRED';
                document.getElementById('countdown-timer').style.color = '#e74c3c';
            }
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
    </script>
    @endif
    @if(config('app.env') === 'local' || config('app.env') === 'development')
    <script>
        function simulateXenditPayment(status) {
            if (!confirm(`Apakah Anda yakin ingin mensimulasikan pembayaran Xendit dengan status: ${status}?`)) {
                return;
            }
            const externalId = '{{ request()->get("external_id") ?? ($transaksi->external_id ?? "") }}';
            if (!externalId) {
                alert('External ID tidak ditemukan');
                return;
            }
            const buttons = document.querySelectorAll('.simulation-buttons button');
            buttons.forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            });
            fetch('{{ route("payment.xendit-simulate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    external_id: externalId,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Simulasi Xendit berhasil! Status: ${status}\nSilakan klik "Verify & Update Status" untuk update database.`);
                } else {
                    alert('Simulasi Xendit gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Xendit simulation error:', error);
                alert('Terjadi kesalahan saat simulasi Xendit: ' + error.message);
            })
            .finally(() => {
                buttons.forEach((btn, index) => {
                    btn.disabled = false;
                    const icons = ['fas fa-check', 'fas fa-times', 'fas fa-clock'];
                    const texts = ['Simulasi Bayar (Xendit API)', 'Simulasi Gagal (Xendit API)', 'Simulasi Expired (Xendit API)'];
                    btn.innerHTML = `<i class="${icons[index]} me-1"></i>${texts[index]}`;
                });
            });
        }
    </script>
    @endif
    <script>
        function verifyPaymentStatus() {
            const externalId = '{{ request()->get("external_id") ?? ($transaksi->external_id ?? "") }}';
            if (!externalId) {
                alert('External ID tidak ditemukan');
                return;
            }
            const button = document.querySelector('button[onclick="verifyPaymentStatus()"]');
            const originalHTML = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
            fetch('{{ route("payment.verify-update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    external_id: externalId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Verify response:', data); // Debug log
                if (data.success) {
                    let message = `✅ Verifikasi berhasil!\n\n`;
                    message += `External ID: ${data.data.external_id}\n`;
                    message += `Status Lama: ${data.data.old_status}\n`;
                    message += `Status Baru: ${data.data.current_status}\n`;
                    message += `Payment Status: ${data.data.payment_status}\n`;
                    message += `Xendit Status: ${data.data.xendit_status}\n`;
                    message += `Database Updated: ${data.data.database_updated ? 'Ya' : 'Tidak'}\n`;
                    if (data.data.database_updated) {
                        message += `\n🎉 Status pembayaran berhasil diperbarui!`;
                        alert(message);
                        location.reload(); // Refresh to show updated status
                    } else {
                        message += `\n💡 Status sudah up-to-date, tidak perlu diubah.`;
                        alert(message);
                    }
                } else {
                    alert(`❌ Verifikasi gagal: ${data.message}`);
                }
            })
            .catch(error => {
                console.error('Verification error:', error);
                alert('Terjadi kesalahan saat verifikasi: ' + error.message);
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalHTML;
            });
        }
        function checkPaymentStatus() {
            const externalId = '{{ request()->get("external_id") ?? ($transaksi->external_id ?? "") }}';
            if (!externalId) {
                alert('External ID tidak ditemukan');
                return;
            }
            const button = document.querySelector('button[onclick="checkPaymentStatus()"]');
            const originalHTML = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            fetch('{{ route("payment.check-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    external_id: externalId
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        console.error('Non-JSON response:', text);
                        throw new Error('Response is not JSON');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Status check response:', data);
                if (data.success) {
                    const info = data.data;
                    let message = `Status Check Results:\n\n`;
                    message += `External ID: ${info.external_id}\n`;
                    message += `Local Status: ${info.local_status}\n`;
                    message += `Xendit Status: ${info.xendit_status}\n`;
                    message += `Last Updated: ${info.last_updated}\n`;
                    if (info.xendit_status === 'api_error') {
                        message += `\nNote: ${info.note}`;
                        message += `\nError: ${info.xendit_error}`;
                    } else if (info.xendit_status === 'not_found') {
                        message += `\n✅ DEVELOPMENT MODE:`;
                        message += `\n• Local payment: VALID `;
                        message += `\n• Xendit status: Not found (normal untuk development)`;
                        message += `\n• Sistem: Berfungsi dengan baik!`;
                    } else if (info.mock_data) {
                        message += `\n🔧 DEVELOPMENT MODE - Mock Data`;
                        message += `\n${info.note}`;
                    }
                    alert(message);
                } else {
                    alert('Gagal mengecek status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Status check error:', error);
                alert('Terjadi kesalahan saat mengecek status: ' + error.message);
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalHTML;
            });
        }
        function verifyAndUpdatePayment() {
            const externalId = '{{ request()->get("external_id") ?? ($transaksi->external_id ?? "") }}';
            if (!externalId) {
                alert('External ID tidak ditemukan');
                return;
            }
            const button = document.querySelector('button[onclick="verifyAndUpdatePayment()"]');
            const originalHTML = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memverifikasi...';
            fetch('{{ route("payment.verify-update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    external_id: externalId
                })
            })
            .then(response => {
                console.log('Verification response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        console.error('Non-JSON response:', text);
                        throw new Error('Response is not JSON');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Verification response:', data);
                if (data.success) {
                    const info = data.data;
                    let message = '';
                    if (info.updated) {
                        message = `✅ PEMBAYARAN BERHASIL DIKONFIRMASI!\n\n`;
                        message += `External ID: ${info.external_id}\n`;
                        message += `Status: ${info.status.toUpperCase()}\n`;
                        message += `Verified at: ${info.verified_at}\n`;
                        message += `Xendit Status: ${info.xendit_status}\n\n`;
                        message += `Database telah diperbarui secara otomatis!`;
                        alert(message);
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else if (info.already_paid) {
                        message = `ℹ️ Pembayaran sudah dikonfirmasi sebelumnya.\n\n`;
                        message += `Status: PAID`;
                        alert(message);
                    } else {
                        message = `⏳ Pembayaran belum dikonfirmasi.\n\n`;
                        message += `External ID: ${info.external_id}\n`;
                        message += `Status saat ini: ${info.status}\n`;
                        message += `Verified at: ${info.verified_at}\n\n`;
                        message += `Silakan coba lagi nanti atau hubungi customer service.`;
                        alert(message);
                    }
                } else {
                    alert('Verifikasi gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Verification error:', error);
                alert('Terjadi kesalahan saat verifikasi: ' + error.message);
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalHTML;
            });
        }
        function checkPaymentStatus() {
            const externalId = '{{ request()->get("external_id") ?? ($transaksi->external_id ?? "") }}';
            if (!externalId) {
                alert('External ID tidak ditemukan');
                return;
            }
            const button = document.querySelector('button[onclick="checkPaymentStatus()"]');
            const originalHTML = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            fetch('{{ route("payment.check-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    external_id: externalId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(`Status Check:\nStatus: ${data.data.payment_status}\nExternal ID: ${data.data.external_id}`);
                } else {
                    alert('Gagal mengecek status: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Status check error:', error);
                alert('Terjadi kesalahan saat mengecek status: ' + error.message);
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = originalHTML;
            });
        }
    </script>
</body>
</html>
