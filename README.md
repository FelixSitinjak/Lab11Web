# Lab 11 PHP OOP & Routing

Aplikasi contoh sederhana (praktikum) yang menampilkan pola OOP dasar, routing modular, dan CRUD sederhana untuk data pengguna. Proyek ini ditujukan untuk dijalankan di XAMPP (Apache + PHP + MySQL).

## Fitur
- **Routing sederhana** berbasis `PATH_INFO` (format: `/modul/halaman`).
- **Arsitektur modular** dengan folder `module/<nama_modul>/<halaman>.php`.
- **Kelas bantuan**: `Database` (mysqli) dan `Form` (render form sederhana).
- **Modul Artikel (User)**: daftar dan tambah data user.
- **Template terpisah**: header, sidebar, footer.

## Struktur Folder
```
lab11_php_oop/
├─ .htaccess
├─ assets/
│  └─ style.css
├─ class/
│  ├─ database.php
│  └─ form.php
├─ module/
│  ├─ home/
│  │  └─ index.php
│  └─ artikel/
│     ├─ index.php      (list user)
│     ├─ tambah.php     (tambah user)
│     └─ ubah.php       (ubah user)
├─ template/
│  ├─ header.php
│  ├─ sidebar.php
│  └─ footer.php
├─ config.php           (konfigurasi DB)
└─ index.php            (router utama)
```

## Persyaratan
- PHP 7.4+ (direkomendasikan) atau 8.x
- MySQL/MariaDB
- XAMPP atau stack serupa (Apache + PHP + MySQL)

## Instalasi & Setup
1. Clone/copy folder ini ke direktori web Anda, misal pada Windows (XAMPP):
   - `c:/xampp/htdocs/lab11_php_oop`
2. Buat database dan tabel.
   - Nama DB default: `latihan_oop` (sesuai `config.php` dan `class/Database.php`).
   - SQL contoh untuk membuat skema dan tabel `users`:

```sql
CREATE DATABASE IF NOT EXISTS latihan_oop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE latihan_oop;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  pass VARCHAR(100) NOT NULL,
  jenis_kelamin ENUM('L','P') DEFAULT NULL,
  agama VARCHAR(50) DEFAULT NULL,
  hobi VARCHAR(255) DEFAULT NULL,
  alamat TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

3. Sesuaikan konfigurasi database bila perlu:
   - File `config.php`:

```php
<?php
$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db_name' => 'latihan_oop'
];
```

Catatan: `class/Database.php` saat ini juga menyetel kredensial secara hardcoded. Pastikan nilai di sana konsisten dengan `config.php` atau refactor untuk hanya mengambil dari `config.php`.

## Menjalankan Aplikasi
- Nyalakan Apache dan MySQL melalui XAMPP.
- Akses di browser:
  - `http://localhost/lab11_php_oop/index.php` → otomatis ke `/home/index`.
  - `http://localhost/lab11_php_oop/index.php/artikel/index` → daftar user.
  - `http://localhost/lab11_php_oop/index.php/artikel/tambah` → form tambah user.

## Mekanisme Routing
- `index.php` membaca `PATH_INFO` dan memetakan ke `module/<mod>/<page>.php`.
- Contoh: `/artikel/tambah` → `module/artikel/tambah.php`.
- Jika file tidak ditemukan, akan menampilkan pesan error modul tidak ditemukan.

## Catatan Penting
- Kelas `Database` menggunakan query langsung (tanpa prepared statements). Untuk produksi, pertimbangkan prepared statements/ORM dan validasi/sanitasi input.
- Kelas `Form` yang tersedia saat ini merender input teks sederhana. File `module/artikel/tambah.php` menambahkan parameter tipe/opsi tambahan; Anda dapat memperluas `Form` untuk mendukung `password`, `radio`, `select`, `checkbox`, dan `textarea` sesuai kebutuhan.
- Pastikan `.htaccess` di root aktif bila Anda memanfaatkan fitur tertentu di Apache. Proyek ini tetap berjalan dengan akses langsung ke `index.php` seperti contoh URL di atas.

## Lisensi
Proyek ini ditujukan untuk keperluan pembelajaran/praktikum. Gunakan dan modifikasi seperlunya.
