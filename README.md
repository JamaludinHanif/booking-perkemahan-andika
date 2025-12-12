# Sistem Manajemen Surat

Aplikasi manajemen surat berbasis web yang dibangun dengan Laravel untuk memudahkan pengelolaan surat-surat administrasi seperti Surat Keterangan Domisili (SKD), Surat Keterangan Tidak Mampu (SKTM), dan Surat Keterangan Usaha (SHU).

## Fitur

- **Login admin & masyarakat**
- **Pengajuan surat online (SKU, SKTM, Domisili, dll.)**
- **Tracking status surat**
- **Dashboard admin untuk verifikasi dan cetak dokumen**
- **Arsip surat otomatis**

## Requirements

- PHP 8.3
- Composer
- MySQL/MariaDB
- Apache/Nginx

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di local environment:

### 1. Clone Repository

```bash
git clone <repository-url>
cd <project-directory>
```

### 2. Setup Environment

Buat file `.env` dengan menyalin dari `.env.example`:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Storage Link

```bash
php artisan storage:link
```

### 6. Run Database Migration

```bash
php artisan migrate
```

### 7. Seed Initial Data

Jalankan Laravel Tinker untuk membuat data awal:

```bash
php artisan tinker
```

Kemudian paste dan jalankan kode berikut di dalam Tinker:

```php
User::create([
    'name' => 'Admin Muhammad Galih',
    'role' => 'admin',
    'username' => 'galih',
    'email' => 'muhammadgalih@gmail.com',
    'password' => bcrypt('12345678')
]);

SuratTypes::create([
    'name' => 'Surat Keterangan Domisili (SKD)',
    'template_view' => 'template_skd',
]);

SuratTypes::create([
    'name' => 'Surat Keterangan Tidak Mampu (SKTM)',
    'template_view' => 'template_sktm',
]);

SuratTypes::create([
    'name' => 'Surat Keterangan Usaha (SHU)',
    'template_view' => 'template_shu',
]);
```

Ketik `exit` untuk keluar dari Tinker.

### 8. Run Application

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akses Aplikasi

### Portal Masyarakat
```
URL: http://localhost:8000/masyarakat
```
Portal untuk masyarakat mengajukan surat

### Dashboard Admin
```
URL: http://localhost:8000/admin
Username: galih
Password: 12345678
```
Dashboard untuk admin mengelola pengajuan surat

## Jenis Surat yang Tersedia

1. **Surat Keterangan Domisili (SKD)** - Surat keterangan domisili
2. **Surat Keterangan Tidak Mampu (SKTM)** - Surat keterangan tidak mampu
3. **Surat Keterangan Usaha (SHU)** - Surat keterangan usaha

## Tech Stack

- **Framework**: Laravel
- **PHP Version**: 8.3
- **Database**: MySQL
- **Frontend**: Blade Template Engine
