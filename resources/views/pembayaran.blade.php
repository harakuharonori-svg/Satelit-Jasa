<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran {{ $jasa->judul }} - SatelitJasa</title>
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
        --success-green: #198754;
        --warning-orange: #fd7e14;
        --accent-blue: #0d6efd;
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

    .payment-container {
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

    .payment-card {
        background: var(--primary-white);
        border-radius: 25px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid var(--border-gray);
        width: 100%;
        max-width: 600px;
        position: relative;
        overflow: hidden;
    }

    .payment-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 0, 0, 0.02) 0%, transparent 70%);
        pointer-events: none;
    }

    .payment-header {
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .payment-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--accent-blue), var(--success-green));
        border-radius: 50%;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-white);
        font-size: 2rem;
        transition: transform 0.3s ease;
    }

    .payment-icon:hover {
        transform: scale(1.05);
    }

    .payment-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-black);
        margin-bottom: 0.5rem;
    }

    .payment-subtitle {
        color: var(--text-gray);
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .order-summary {
        background: linear-gradient(135deg, var(--soft-gray), var(--primary-white));
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-gray);
        position: relative;
        z-index: 2;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-gray);
    }

    .order-item:last-child {
        border-bottom: none;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--primary-black);
    }

    .order-item .label {
        color: var(--text-gray);
    }

    .order-item .value {
        font-weight: 500;
        color: var(--primary-black);
    }

    .deadline-section {
        background: var(--primary-white);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border: 1px solid var(--border-gray);
        position: relative;
        z-index: 2;
    }

    .deadline-section h5 {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .deadline-option {
        background: var(--primary-white);
        border: 2px solid var(--border-gray);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .deadline-option:hover {
        border-color: var(--primary-black);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .deadline-option.selected {
        border-color: var(--primary-black);
        background: var(--soft-gray);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

        .deadline-option.selected::after {
        content: '✓';
        position: absolute;
        top: 10px;
        right: 15px;
        background: var(--primary-black);
        color: var(--primary-white);
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
    }

    /* Ensure clickability */
    .deadline-option * {
        pointer-events: none;
    }

    .payment-method * {
        pointer-events: none;
    }

    .deadline-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .deadline-title {
        font-weight: 600;
        color: var(--primary-black);
        font-size: 1.1rem;
    }

    .deadline-desc {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .deadline-price {
        font-weight: 600;
        font-size: 1rem;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        background: var(--light-blue);
        color: var(--primary-blue);
        border: 1px solid var(--primary-blue);
    }

    .deadline-option[data-multiplier="1.5"] .deadline-price {
        background: #fff3cd;
        color: #856404;
        border-color: #ffeaa7;
    }

    .deadline-option[data-multiplier="0.5"] .deadline-price {
        background: #d1f2eb;
        color: #00b894;
        border-color: #00cec9;
    }

    .payment-methods {
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .payment-methods h5 {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .payment-method {
        background: var(--primary-white);
        border: 2px solid var(--border-gray);
        border-radius: 15px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        overflow: hidden;
    }

    .payment-method:hover {
        border-color: var(--primary-black);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .payment-method.selected {
        border-color: var(--success-green);
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.05), var(--primary-white));
    }

    .payment-method.selected::after {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        top: 1rem;
        right: 1rem;
        color: var(--success-green);
        font-size: 1.2rem;
    }

    .bank-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border-radius: 10px;
        padding: 0.5rem;
        background: var(--primary-white);
        border: 1px solid var(--border-gray);
        transition: transform 0.3s ease;
    }

    .payment-method:hover .bank-logo {
        transform: scale(1.05);
    }

    .bank-info h6 {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 0.25rem;
    }

    .bank-info p {
        color: var(--text-gray);
        font-size: 0.9rem;
        margin: 0;
    }

    .payment-actions {
        display: flex;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }

    .btn-modern {
        flex: 1;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
    }

    .btn-primary-modern {
        background: var(--primary-black);
        border-color: var(--primary-black);
        color: var(--primary-white);
    }

    .btn-primary-modern:hover {
        background: transparent;
        color: var(--primary-black);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-secondary-modern {
        background: transparent;
        border-color: var(--border-gray);
        color: var(--text-gray);
    }

    .btn-secondary-modern:hover {
        background: var(--hover-gray);
        border-color: var(--text-gray);
        color: var(--primary-black);
    }

    .security-info {
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.05), rgba(25, 135, 84, 0.02));
        border: 1px solid rgba(25, 135, 84, 0.2);
        border-radius: 15px;
        padding: 1rem;
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }

    .security-info i {
        color: var(--success-green);
        font-size: 1.5rem;
    }

    .security-info p {
        margin: 0;
        color: var(--text-gray);
        font-size: 0.9rem;
    }


    @media (max-width: 768px) {
        .payment-container {
            padding: 1rem;
        }

        .back-btn {
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
        }

        .payment-card {
            padding: 2rem;
            border-radius: 20px;
        }

        .payment-title {
            font-size: 1.7rem;
        }

        .payment-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .payment-actions {
            flex-direction: column;
        }

        .bank-logo {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 576px) {
        .back-btn span {
            display: none;
        }

        .payment-card {
            padding: 1.5rem;
            border-radius: 15px;
        }

        .payment-method {
            padding: 1rem;
        }

        .btn-modern {
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
        }
    }


    .btn-modern.loading {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-modern.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        right: 1rem;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }


    .payment-category {
        margin-bottom: 2rem;
    }

    .payment-category h6 {
        font-weight: 600;
        color: var(--primary-black);
        margin-bottom: 1rem;
        padding-left: 0.5rem;
        border-left: 4px solid var(--accent-blue);
    }
</style>

<body>

    <a href="{{ route('jasa.detail', $jasa->id) }}" class="back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Kembali</span>
    </a>


    <div class="payment-container">
        <div class="payment-card">

            <div class="payment-header">
                <div class="payment-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h1 class="payment-title">Pembayaran {{ $jasa->judul }}</h1>
                <p class="payment-subtitle">Penyedia: {{ $jasa->store->user->nama }} - {{ $jasa->store->nama }}</p>
            </div>


            <div class="order-summary">
                <div class="order-item">
                    <span class="label">
                        <i class="fas fa-briefcase me-2"></i>
                        {{ $jasa->judul }}
                    </span>
                    <span class="value">Rp {{ number_format($jasa->harga, 0, ',', '.') }}</span>
                </div>
                <div class="order-item">
                    <span class="label">
                        <i class="fas fa-shipping-fast me-2"></i>
                        Biaya Admin
                    </span>
                    <span class="value">Rp 5.000</span>
                </div>
                @php
                    $biayaAdmin = 5000;
                    $totalPembayaran = $jasa->harga + $biayaAdmin;
                @endphp
                <div class="order-item">
                    <span class="label">
                        <i class="fas fa-calculator me-2"></i>
                        <strong>Total Pembayaran</strong>
                    </span>
                    <span class="value text-success">
                        <strong>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</strong>
                    </span>
                </div>
            </div>

            <!-- Deadline Section -->
            <div class="deadline-section">
                <h5>
                    <i class="fas fa-calendar-alt"></i>
                    Pilih Deadline Pengerjaan
                </h5>

                <div class="deadline-option" data-deadline="7" data-multiplier="1.5">
                    <div class="deadline-info">
                        <div class="deadline-title">Seminggu (7 hari)</div>
                        <div class="deadline-desc">Pengerjaan cepat, prioritas tinggi</div>
                    </div>
                    <div class="deadline-price">+50% (Urgent)</div>
                </div>

                <div class="deadline-option" data-deadline="30" data-multiplier="1.0">
                    <div class="deadline-info">
                        <div class="deadline-title">Sebulan (30 hari)</div>
                        <div class="deadline-desc">Waktu standar, kualitas optimal</div>
                    </div>
                    <div class="deadline-price">Harga Normal</div>
                </div>

                <div class="deadline-option" data-deadline="90" data-multiplier="0.5">
                    <div class="deadline-info">
                        <div class="deadline-title">Tiga bulan (90 hari)</div>
                        <div class="deadline-desc">Waktu fleksibel, hasil maksimal</div>
                    </div>
                    <div class="deadline-price">-50% (Hemat)</div>
                </div>
            </div>


            <div class="payment-methods">
                <h5>
                    <i class="fas fa-wallet"></i>
                    Metode Pembayaran
                </h5>


                <div class="payment-category">
                    <h6>Transfer Bank</h6>

                    <div class="payment-method" onclick="selectPayment(this, 'bca')" data-method="bca">
                        <img src="/images/lg-bca.png" alt="BCA" class="bank-logo">
                        <div class="bank-info">
                            <h6>Bank Central Asia (BCA)</h6>
                            <p>Transfer langsung ke rekening BCA</p>
                        </div>
                    </div>

                    <div class="payment-method" onclick="selectPayment(this, 'bri')" data-method="bri">
                        <img src="/images/Logo-BRI.png" alt="BRI" class="bank-logo">
                        <div class="bank-info">
                            <h6>Bank Rakyat Indonesia (BRI)</h6>
                            <p>Transfer langsung ke rekening BRI</p>
                        </div>
                    </div>

                    <div class="payment-method" onclick="selectPayment(this, 'bni')" data-method="bni">
                        <img src="/images/LogoBNI.png" alt="BNI" class="bank-logo">
                        <div class="bank-info">
                            <h6>Bank Negara Indonesia (BNI)</h6>
                            <p>Transfer langsung ke rekening BNI</p>
                        </div>
                    </div>

                    <div class="payment-method" onclick="selectPayment(this, 'cimb')" data-method="cimb">
                        <img src="/images/logo-niaga.png" alt="CIMB Niaga" class="bank-logo">
                        <div class="bank-info">
                            <h6>CIMB Niaga</h6>
                            <p>Transfer langsung ke rekening CIMB Niaga</p>
                        </div>
                    </div>
                </div>


                {{-- <div class="payment-category">
                    <h6>Pembayaran Digital</h6>

                    <div class="payment-method" onclick="selectPayment(this, 'qris')" data-method="qris">
                        <img src="/images/LogoQriss.webp" alt="QRIS" class="bank-logo">
                        <div class="bank-info">
                            <h6>QRIS</h6>
                            <p>Scan QR Code untuk pembayaran instan</p>
                        </div>
                    </div>
                </div> --}}
            </div>


            <div class="security-info">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <p><strong>Transaksi Aman:</strong> Semua pembayaran dilindungi dengan enkripsi SSL 256-bit dan
                        sistem keamanan berlapis.</p>
                </div>
            </div>


            <div class="payment-actions">
                <a href="{{ route('jasa.detail', $jasa->id) }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button class="btn-modern btn-primary-modern" onclick="processPayment()" id="paymentBtn" disabled>
                    <i class="fas fa-lock"></i>
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>

    <script>
        let selectedPaymentMethod = null;
        let selectedDeadline = null;
        let basePrice = {{ $jasa->harga }};
        let adminFee = 5000;

        function selectDeadline(days, multiplier, title) {
            console.log('selectDeadline called with:', days, multiplier, title);
            
            document.querySelectorAll('.deadline-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class ke yang dipilih berdasarkan data-deadline
            const selectedOption = document.querySelector(`[data-deadline="${days}"]`);
            if (selectedOption) {
                selectedOption.classList.add('selected');
                console.log('Added selected class to deadline option');
            }

            selectedDeadline = {
                days: days,
                multiplier: multiplier
            };
            
            updateTotalPrice();
            
            console.log(`Deadline dipilih: ${title} (${days} hari) - Multiplier: ${multiplier}`);
        }

        function selectPaymentMethod(method) {
            // Remove active class dari semua payment methods
            document.querySelectorAll('.payment-method').forEach(pm => {
                pm.classList.remove('selected');
            });

            // Add selected class ke yang dipilih
            const selectedMethod = document.querySelector(`[data-method="${method}"]`);
            if (selectedMethod) {
                selectedMethod.classList.add('selected');
            }

            selectedPaymentMethod = method;

            updatePaymentButton();
        }

        function updateTotalPrice() {
            if (!selectedDeadline) return;

            const adjustedPrice = Math.round(basePrice * selectedDeadline.multiplier);
            const totalPrice = adjustedPrice + adminFee;

            // Update harga jasa di order summary
            const jasaPriceElement = document.querySelector('.order-item .value');
            if (jasaPriceElement) {
                jasaPriceElement.textContent = 'Rp ' + adjustedPrice.toLocaleString('id-ID');
            }

            // Update total harga
            const totalElement = document.querySelector('.order-item:last-child .value strong');
            if (totalElement) {
                totalElement.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
            }

            // Update tombol pembayaran
            const paymentBtn = document.getElementById('paymentBtn');
            if (paymentBtn && selectedPaymentMethod) {
                paymentBtn.innerHTML = `<i class="fas fa-lock"></i> Bayar Rp ${totalPrice.toLocaleString('id-ID')}`;
            }
        }

        function selectPayment(element, method) {
            console.log('selectPayment called with method:', method);
            
            document.querySelectorAll('.payment-method').forEach(pm => {
                pm.classList.remove('selected');
            });

            element.classList.add('selected');
            selectedPaymentMethod = method;

            console.log('selectedPaymentMethod set to:', selectedPaymentMethod);
            updatePaymentButton();
        }

        function updatePaymentButton() {
            const paymentBtn = document.getElementById('paymentBtn');
            if (selectedPaymentMethod && selectedDeadline) {
                paymentBtn.disabled = false;
                paymentBtn.innerHTML = '<i class="fas fa-lock"></i> Bayar Sekarang';
            } else {
                paymentBtn.disabled = true;
                paymentBtn.innerHTML = '<i class="fas fa-lock"></i> Pilih Deadline & Metode Pembayaran';
            }
        }

        function processPayment() {
            if (!selectedPaymentMethod) {
                alert('Silakan pilih metode pembayaran terlebih dahulu');
                return;
            }

            if (!selectedDeadline) {
                alert('Silakan pilih deadline pengerjaan terlebih dahulu');
                return;
            }

            const paymentBtn = document.getElementById('paymentBtn');
            paymentBtn.classList.add('loading');
            paymentBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            console.log('Selected payment method:', selectedPaymentMethod);
            console.log('Selected deadline:', selectedDeadline);

            // Prepare payment data
            const paymentData = {
                jasa_id: {{ $jasa->id }},
                payment_method: selectedPaymentMethod,
                deadline: selectedDeadline.days,
                _token: '{{ csrf_token() }}'
            };

            console.log('Payment data:', paymentData);

            // Send payment request to server
            fetch('{{ route("payment.process") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(paymentData)
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Response is not JSON');
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Success response:', data);
                paymentBtn.classList.remove('loading');
                
                if (data.success) {
                    alert('Pembayaran berhasil dibuat! Anda akan diarahkan ke halaman pembayaran.');
                    
                    // Handle different payment methods
                    if (data.data.invoice_url) {
                        window.location.href = data.data.invoice_url;
                    } else if (data.data.qr_string) {
                        window.location.href = '{{ route("payment.success") }}?external_id=' + (data.data.external_id || 'unknown');
                    } else if (data.data.account_number) {
                        window.location.href = '{{ route("payment.success") }}?external_id=' + (data.data.external_id || 'unknown');
                    } else {
                        // Default success redirect with external_id
                        const externalId = data.data.external_id || 'TXN-' + data.data.transaksi_id + '-' + Date.now();
                        window.location.href = '{{ route("payment.success") }}?external_id=' + externalId;
                    }
                } else {
                    alert('Gagal membuat pembayaran: ' + data.message);
                    paymentBtn.innerHTML = '<i class="fas fa-lock"></i> Bayar Sekarang';
                }
            })
            .catch(error => {
                console.error('Payment error details:', error);
                paymentBtn.classList.remove('loading');
                alert('Terjadi kesalahan saat memproses pembayaran: ' + error.message + '. Silakan coba lagi.');
                paymentBtn.innerHTML = '<i class="fas fa-lock"></i> Bayar Sekarang';
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const paymentMethods = document.querySelectorAll('.payment-method');
            paymentMethods.forEach((method, index) => {
                method.style.opacity = '0';
                method.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    method.style.transition = 'all 0.5s ease';
                    method.style.opacity = '1';
                    method.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Event listener untuk deadline options
            const deadlineOptions = document.querySelectorAll('.deadline-option');
            console.log('Found deadline options:', deadlineOptions.length);
            deadlineOptions.forEach((option, index) => {
                console.log(`Deadline option ${index}:`, option.dataset.deadline, option.dataset.multiplier);
                option.addEventListener('click', function () {
                    console.log('Deadline option clicked:', this.dataset.deadline);
                    selectDeadline(this.dataset.deadline, parseFloat(this.dataset.multiplier), this.querySelector('.deadline-title').textContent.trim());
                });
            });

            // Set default payment method (pilih BCA sebagai default)
            if (paymentMethods.length > 0) {
                selectPayment(paymentMethods[0], paymentMethods[0].dataset.method);
            }

            // Set default deadline (30 hari - harga normal)
            if (deadlineOptions.length > 0) {
                selectDeadline(30, 1.0, 'Sebulan (30 hari)');
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && selectedPaymentMethod) {
                processPayment();
            }
        });
    </script>
</body>

</html>