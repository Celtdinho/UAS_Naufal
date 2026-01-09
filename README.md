# 🚗 Aplikasi Penyewaan Mobil - Web Rental Car System

Aplikasi web penyewaan mobil dengan sistem login dual role (admin/user), CRUD lengkap, pencarian, dan pagination. Dibangun untuk memenuhi tugas UAS Pemrograman Web.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

## 📋 Fitur Utama

### 👨‍💼 **Admin Features**
- Kelola data mobil (CRUD lengkap)
- Kelola transaksi penyewaan
- Update status penyewaan
- Filter dan pencarian data
- Dashboard statistik

### 👤 **User Features**
- Register dan login user
- Lihat mobil tersedia
- Sewa mobil dengan tanggal pilihan
- Lihat riwayat penyewaan
- Filter dan pencarian mobil

### 🔧 **Fitur Teknis**
- Sistem login dengan dual role (admin/user)
- Routing dengan .htaccess
- CRUD lengkap dengan validasi
- Pencarian real-time dengan filter
- Pagination data
- Upload gambar mobil
- Responsive design (mobile-first)
- UI dengan tema biru muda

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 7.4+ (Native, OOP, MVC Pattern)
- **Database:** MySQL
- **Frontend:** Bootstrap 5, CSS3, JavaScript, Font Awesome
- **Server:** Apache (mod_rewrite enabled)
- **Other:** PDO, Session Management, File Upload

## 📁 Struktur Proyek
rental-mobil/
├── index.php # Main entry point
├── .htaccess # URL routing
├── config/
│ ├── database.php # Database configuration
│ └── constants.php # Constants and base URL
│
├── app/
│ ├── core/ # Core classes
│ │ ├── Controller.php
│ │ ├── Model.php
│ │ └── Database.php
│ │
│ ├── controllers/ # Controllers
│ │ ├── HomeController.php
│ │ ├── AuthController.php
│ │ ├── MobilController.php
│ │ ├── SewaController.php
│ │ └── DashboardController.php
│ │
│ ├── models/ # Models
│ │ ├── UserModel.php
│ │ ├── MobilModel.php
│ │ └── SewaModel.php
│ │
│ └── views/ # Views
│ ├── layouts/ # Layout templates
│ ├── home/ # Home pages
│ ├── auth/ # Authentication pages
│ ├── mobil/ # Car management pages
│ ├── sewa/ # Rental pages
│ └── dashboard/ # Dashboard pages
│
├── public/
│ ├── uploads/ # Image upload directory
│ └── [assets - css/js]
│
└── database.sql # Database schema

text

## 🚀 Instalasi dan Setup

### **Lokal (XAMPP/WAMP)**

1. **Clone repository**
   ```bash
   git clone https://github.com/username/rental-mobil.git
   cd rental-mobil
Setup database

Buat database rental_mobil_db di phpMyAdmin

Import file database.sql

Konfigurasi aplikasi

Edit config/database.php:

php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rental_mobil_db');
Edit config/constants.php:

php
define('BASEURL', 'http://localhost/rental-mobil');
Set permissions

bash
chmod 755 public/uploads
Jalankan aplikasi

Start Apache & MySQL

Buka: http://localhost/rental-mobil

Hosting (InfinityFree/Shared Hosting)
Upload semua file ke public_html/

Edit config/database.php dengan credentials hosting

Edit config/constants.php dengan domain Anda

Import database.sql via phpMyAdmin

Set folder public/uploads permission ke 755

👥 Login Default
Admin
text
Username: admin
Password: password
Email: admin@rental.com
Role: Administrator
User
Register melalui halaman register

Atau gunakan SQL untuk membuat user baru

📱 Screenshots
Login Page
https://screenshots/Login.png

Admin Dashboard
https://screenshots/Dashboard_admin.png

Kelola Mobil
https://screenshots/Edit_admin.png

Daftar Sewa
https://screenshots/Daftar_sewa.png

User Dashboard
https://screenshots/Dashboard_user.png

Form Sewa User
https://screenshots/Form.png

🎥 Video Demonstrasi
(https://youtu.be/iGpSocZ7IWw)

Video penjelasan lengkap: Link YouTube

🔧 Database Schema
Tabel Users
sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Tabel Mobil
sql
CREATE TABLE mobil (
    id INT PRIMARY KEY AUTO_INCREMENT,
    merk VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    tahun INT NOT NULL,
    plat_nomor VARCHAR(15) UNIQUE NOT NULL,
    harga_per_hari DECIMAL(10,2) NOT NULL,
    status ENUM('tersedia', 'tidak tersedia') DEFAULT 'tersedia',
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Tabel Sewa
sql
CREATE TABLE sewa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    mobil_id INT NOT NULL,
    tanggal_sewa DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'disetujui', 'ditolak', 'selesai') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (mobil_id) REFERENCES mobil(id)
);
🌐 Demo Online
Live Demo: https://rental-mobil.infinityfreeapp.com

Credentials:

Admin: admin / admin123

User: Register melalui halaman register

📝 Fitur yang Diimplementasikan
Fitur	Status	Keterangan
OOP & MVC Architecture	✅	Struktur Model-View-Controller
Routing dengan .htaccess	✅	Clean URL dengan mod_rewrite
Responsive Design	✅	Mobile-first dengan Bootstrap 5
Login System Dual Role	✅	Admin dan User
CRUD Lengkap	✅	Create, Read, Update, Delete
Filter & Pencarian	✅	Real-time search dengan AJAX
Pagination	✅	Data terbagi per halaman
File Upload	✅	Upload gambar mobil
Form Validation	✅	Validasi client & server side
Session Management	✅	PHP Session dengan timeout
🚀 Cara Menggunakan
Untuk Admin:
Login dengan akun admin

Tambah data mobil melalui menu "Kelola Mobil"

Kelola penyewaan melalui menu "Daftar Sewa"

Lihat statistik di Dashboard

Untuk User:
Register akun baru

Login dengan akun yang dibuat

Cari mobil tersedia

Sewa mobil dengan memilih tanggal

Lihat riwayat sewa di menu "Daftar Sewa"

📄 Dokumentasi
Video Dokumentasi:
Durasi: 10 menit

Format: MP4, 1080p

Konten: Penjelasan fitur, demo lengkap, cara instalasi

Link: YouTube

PDF Dokumentasi:
Download PDF Dokumentasi

Isi: Screenshot semua fitur, penjelasan kode, struktur database

🔍 Troubleshooting
Error Database Connection
php
// Pastikan di config/database.php
define('DB_HOST', 'localhost'); // atau host server Anda
define('DB_USER', 'root');      // username database
define('DB_PASS', '');          // password database
define('DB_NAME', 'rental_mobil_db'); // nama database
Error 404 Page Not Found
Pastikan mod_rewrite aktif di Apache

Cek file .htaccess sudah ada di root

Restart Apache

Error Upload Gambar
Pastikan folder public/uploads ada

Set permission folder ke 755

Cek ukuran file maksimal

👨‍💻 Developer
Nama: Naufal Rafi Haryanto
NIM: 312410118
Kelas: TI.24.A1
Mata Kuliah: Pemrograman Web 1
Dosen: Bpk. Agung Nugroho, S.Kom., M.Kom.

Kontak:
📧 Email: NoufalHaryanto@gmail.com

🔗 GitHub: @Celtdinho

💼 LinkedIn: Naufal Rafi Haryanto


<div align="center"> <sub> Pemrograman Web</sub> <br> <sub>© 2024 Rental Mobil App</sub> </div> ```
