# 🛒 Admin Penjualan Elektronik
Sistem Admin Penjualan Elektronik berbasis Web menggunakan **CodeIgniter 4** dengan tampilan modern menggunakan **Tailwind CSS**.

Project ini memiliki fitur manajemen produk, dashboard statistik, serta laporan HTML & PDF.

---

## 🚀 Fitur Utama

### 🔐 Authentication
- Login & Logout
- Password menggunakan `password_hash()`
- Route Protection menggunakan Filter (AuthFilter)

### 📦 Manajemen Produk (CRUD)
- Tambah Produk (Upload Thumbnail)
- Edit Produk (Modal Animasi)
- Delete Produk (Modal Konfirmasi Animasi)
- Search Filter
- Timestamp otomatis (`created_at`, `updated_at`)

### 📊 Dashboard Statistik
- Earnings Monthly
- Earnings Annual
- Total Produk
- Line Chart (Earnings per Bulan)
- Donut Chart (Pendapatan per Kategori)
- Laporan Produk Bulan Ini
- Laporan Produk Tahun Ini

### 📄 Laporan
- Laporan HTML
- Export PDF menggunakan Dompdf

---

## 🛠️ Teknologi yang Digunakan

- PHP 8+
- CodeIgniter 4
- MySQL / MariaDB
- Tailwind CSS (CDN)
- Chart.js
- Dompdf
- JavaScript (Vanilla)

---

## 📦 Cara Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/admin-elektronik.git
cd admin-elektronik
```

2️⃣ Install Dependency

Jika menggunakan composer:

```bash
composer install
```

Install Dompdf:

```bash
composer require dompdf/dompdf
```

3️⃣ Setup Database

Buat database baru:

```bash
admin_elektronik
```

🗂 Import Database

Project ini sudah menyediakan file database hasil export:

```bash
data.sql
```

Langkah import:

1. Buka phpMyAdmin

2. Pilih database admin_elektronik

3. Klik tab Import

4. Upload file data.sql

5. Klik Go

Setelah import, tabel dan data default sudah otomatis tersedia.

4️⃣ Konfigurasi File .env

Edit file .env:

```bash
database.default.hostname = localhost
database.default.database = admin_elektronik
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

5️⃣ Jalankan Server

Gunakan perintah:

```bash
php spark serve
```

Akses melalui browser:

```bash
http://localhost:8080
```

🔐 Login Default
```bash
Username: admin
Password: admin
```

Password sudah di-hash menggunakan password_hash().

📁 Struktur Folder Penting
```bash
app/
 ├── Controllers/
 ├── Models/
 ├── Views/
 ├── Filters/
public/
 ├── uploads/
data.sql
```

⚠️ Catatan Penting

Gunakan PHP versi 8 atau lebih tinggi.

Pastikan extension untuk Dompdf aktif.

---

🎓 Tujuan Pembuatan

Project ini dibuat sebagai:

Implementasi sistem informasi berbasis web

Latihan penggunaan CodeIgniter 4

Implementasi dashboard statistik

Implementasi export PDF

Portfolio project pengembangan web

---

👨‍💻 Author

Ilham Firmansyah

---

This project is built using CodeIgniter 4 (MIT License).
Custom business logic and UI are developed by Ilham Firmansyah.
