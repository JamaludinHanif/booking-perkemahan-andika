# Sistem Booking Perkemahan Andika

Aplikasi manajemen surat berbasis web yang dibangun dengan Laravel untuk memudahkan pengelolaan Booking pada perkemahan

## Fitur

- **Login admin & registrast booking customer**
- **Dashboard admin untuk verifikasi da approve booking**
- **Master Area Kemah**

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
    'name' => 'admin andika',
    'role' => 'admin',
    'username' => 'andika',
    'email' => 'andika@gmail.com',
    'password' => bcrypt('andika123')
])

```

Ketik `exit` untuk keluar dari Tinker.

### 8. Run Application

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akses Aplikasi

### Registrasi Booking Customer
```
URL: http://localhost:8000/
```
Halaman untuk pelanggan melakukan Booking

### Dashboard Admin
```
URL: http://localhost:8000/admin
Username: andika
Password: andika123
```
Dashboard untuk admin mengelola booking

## Tech Stack

- **Framework**: Laravel
- **PHP Version**: 8.3
- **Database**: MySQL
- **Frontend**: Blade Template Engine
