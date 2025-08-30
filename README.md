# 🚀 SatelitJasa - Platform Freelance

![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple.svg)

**SatelitJasa** adalah platform freelance modern yang menghubungkan client dengan freelancer menggunakan sistem escrow untuk keamanan transaksi. Platform ini menyediakan sistem pembayaran terintegrasi dengan Xendit, manajemen order yang komprehensif, dan sistem withdrawal untuk freelancer.

## ✨ Fitur Utama

### 🔐 Sistem Escrow
- **Keamanan Transaksi**: Dana client disimpan aman hingga project selesai
- **Auto-Release**: Otomatis release dana setelah 7 hari tanpa dispute
- **Manual Approval**: Client dapat approve/request revision sebelum release

### 💳 Payment Gateway Terintegrasi
- **Virtual Account**: BCA, BNI, BRI, CIMB Niaga
- **Real-time Status**: Update status pembayaran otomatis via webhook

### 📊 Manajemen Order Lengkap
- **Order Tracking**: Status tracking dari pending hingga completed
- **File Delivery**: Upload dan download file project
- **Communication**: Sistem chat antara client dan freelancer

### 💰 Sistem Withdrawal
- **Freelancer Earnings**: Withdrawal pendapatan ke rekening bank
- **Client Refunds**: Sistem refund otomatis untuk order yang dibatalkan
- **Admin Control**: Approval dan management withdrawal oleh admin

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 11.x** - PHP Framework terbaru
- **MySQL 8.0+** - Database relational
- **Xendit API** - Payment gateway Indonesia

### Frontend
- **Bootstrap 5.3** - UI Framework responsive
- **Blade Templates** - Laravel templating engine
- **QRCode.js** - QR Code generation untuk QRIS

### Integrasi
- **Pusher** - Real-time communication
- **Xendit Webhook** - Payment status automation

## 📋 Requirement System

### Minimum Requirements
- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.x
- **MySQL**: 8.0 atau MariaDB 10.3+
- **Node.js**: 16.x+ (untuk build assets)
- **Web Server**: Apache/Nginx

### Extensions PHP yang Diperlukan
```bash
php-mbstring
php-xml
php-curl
php-mysql
php-gd
php-zip
php-intl
```

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/harakuharonori-svg/SatelitJasa.git
cd SatelitJasa
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database
mysql -u root -p
CREATE DATABASE satelitjasa;
EXIT;

# Run migrations dan seeder
php artisan migrate
php artisan db:seed
```

### 5. Storage Setup
```bash
# Create storage link
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## ⚙️ Konfigurasi Environment

### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=satelitjasa
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Xendit Payment Gateway
```env
# Xendit Configuration
XENDIT_API_KEY=xnd_development_188zNVDqMwIjV6cmxSX72JiTXsCWY2DmhqoX9fGLqbStNnjKacHNxp2zGzWGq7NS

# App URL untuk webhook
APP_URL=http://127.0.0.1:8000
```

**📋 Cara Mendapatkan Xendit API Key:**

1. **Daftar/Login ke Xendit Dashboard**
   - Kunjungi: https://dashboard.xendit.co/
   - Daftar akun atau login jika sudah punya

2. **Ambil API Keys**
   - Masuk ke **Settings** → **API Keys**
   - Copy **Secret Key** untuk development mode
   - Format: `xnd_development_xxxxxxxxxxxxxxxx`

3. **Setup Webhook** (untuk production)
   - Masuk ke **Settings** → **Webhooks** 
   - URL: `https://yourdomain.com/webhook/xendit`
   - Events: `invoice.paid`, `invoice.expired`
   - Generate **Verification Token**

4. **Mode Development**
   - Gunakan `xnd_development_` key untuk testing
   - Payment bisa di-simulate tanpa transfer real
   - Webhook bisa ditest dengan ngrok

**⚠️ Penting**: Jangan commit API key production ke repository!

### Pusher Real-time Communication
```env
# Pusher Configuration
PUSHER_APP_ID=2041832
PUSHER_APP_KEY=481eca4a4c7d559949d2
PUSHER_APP_SECRET=c21ea426080a1615b3ef
PUSHER_APP_CLUSTER=ap1

BROADCAST_CONNECTION=pusher
```

### Email Configuration (Optional)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="SatelitJasa"
```

## 🏃‍♂️ Menjalankan Aplikasi

### Development Server
```bash
# Start Laravel development server
php artisan serve

# Akses aplikasi di browser
http://127.0.0.1:8000
```

### Production Setup
```bash
# Optimize aplikasi untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compile assets (jika menggunakan Vite)
npm run build
```

## 👨‍💼 Default Admin Account

Setelah menjalankan seeder, akun admin default akan tersedia:

```
Email: admin@satelitjasa.com
Password: admin123
Role: ADMIN
```

**⚠️ PENTING**: Segera ganti password default setelah login pertama!

## 🗂️ Struktur Database

### Tabel Utama
- **users** - Data pengguna (client/freelancer/admin)
- **stores** - Data toko freelancer
- **jasas** - Data layanan/jasa
- **transaksis** - Data transaksi dan order
- **withdrawals** - Data withdrawal freelancer
- **client_withdrawals** - Data refund client

### Payment & Escrow System
- **payment_data** (JSON) - Data response dari Xendit
- **escrow_status** - Status escrow (held/released/refunded)
- **project_status** - Status project (pending/in_progress/delivered/completed)

## 🔄 Workflow Sistem

### 1. Order Process
```
Client Order → Payment → Escrow Hold → Freelancer Work → 
Delivery → Client Review → Escrow Release → Freelancer Earnings
```

### 2. Payment Flow
```
Create Payment → Xendit API → Payment Success → 
Webhook Update → Escrow Activated → Order Active
```

### 3. Withdrawal Process
```
Freelancer Request → Admin Review → Bank Transfer → 
Status Update → Balance Deduction
```

## 🐛 Troubleshooting

### Common Issues

#### 1. Migration Error
```bash
# Reset migrations
php artisan migrate:reset
php artisan migrate
```

#### 2. Storage Permission
```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage/
sudo chmod -R 755 storage/
```

#### 3. Xendit Webhook Not Working
- Pastikan APP_URL benar di .env
- Check webhook URL di Xendit dashboard
- Verify webhook token

#### 4. Payment Status Not Updating
- Check log: `storage/logs/laravel.log`
- Verify Xendit API key
- Test webhook endpoint manually

## 📊 Monitoring & Logs

### Log Files
```bash
# Application logs
tail -f storage/logs/laravel.log

# Payment logs
grep "Payment" storage/logs/laravel.log

# Error logs
grep "ERROR" storage/logs/laravel.log
```

### Performance Monitoring
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🔒 Security Features

- **CSRF Protection** - Semua form dilindungi CSRF token
- **SQL Injection Prevention** - Menggunakan Eloquent ORM
- **XSS Protection** - Auto-escape Blade templates
- **Escrow System** - Dana aman hingga project selesai
- **Webhook Verification** - Verify Xendit webhook signature

## 📄 API Documentation

### Payment Webhook
```http
POST /webhook/xendit
Content-Type: application/json
X-CALLBACK-TOKEN: your_webhook_token

{
  "external_id": "TXN-123-1234567890",
  "status": "PAID",
  "amount": 100000
}
```

### Internal APIs
- `POST /payment/process` - Create payment
- `POST /payment/verify-update` - Verify payment status
- `POST /escrow/deliver` - Deliver project
- `POST /escrow/approve` - Approve delivery

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📞 Support

Untuk bantuan teknis atau pertanyaan:

- **Email**: admin@satelitjasa.com
- **GitHub Issues**: [Create Issue](https://github.com/harakuharonori-svg/SatelitJasa/issues)
- **Documentation**: [Wiki](https://github.com/harakuharonori-svg/SatelitJasa/wiki)

## 📄 License

Project ini menggunakan [MIT License](LICENSE).

---

### 🎯 Quick Start untuk Juri

```bash
# 1. Setup database dan environment
cp .env.example .env
# Edit .env dengan konfigurasi database dan Xendit

# 2. Install dan migrate
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed

# 3. Jalankan aplikasi
php artisan serve

# 4. Login sebagai admin
# Email: admin@satelitjasa.com
# Password: admin123
```

**🌟 Demo Features:**
- Test payment dengan VA
- Create order sebagai client
- Manage order sebagai freelancer
- Approve withdrawal sebagai admin

---

*Dikembangkan dengan ❤️ menggunakan Laravel untuk menciptakan ekosistem freelance yang aman dan terpercaya di Indonesia.*
