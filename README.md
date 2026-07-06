# KlinikKu - Dashboard Admin Klinik

Aplikasi web berbasis Laravel 13 untuk mengelola pendaftaran pasien, dokter,
jadwal pemeriksaan, antrian, dan rekam medis di sebuah klinik.

## Fitur Utama
- Autentikasi (Login, Register, Logout) via Laravel Breeze
- Manajemen role & permission (Admin, Staff) dengan Spatie Permission
- Dashboard statistik + grafik tren pendaftaran pasien
- CRUD: Pasien, Dokter, Jadwal Pemeriksaan, Antrian, Rekam Medis
- Search & pagination di semua halaman data
- Ambil nomor antrian otomatis + panggil/selesaikan antrian
- REST API (JSON) untuk resource Pasien & Dokter

## Tech Stack
Laravel 13 • PHP 8.3 • MySQL 8 • Blade + Tailwind CSS • Spatie Permission • Breeze

## Struktur Proyek Ini
Folder ini **bukan** proyek Laravel yang lengkap (tidak menyertakan file inti
framework seperti `vendor/`, `public/index.php`, dll — file tersebut dihasilkan
otomatis oleh Composer/Breeze). Folder ini berisi seluruh **kode aplikasi
custom** (model, controller, migration, seeder, view, route) yang tinggal
disalin ke proyek Laravel + Breeze yang baru dibuat.

## Cara Instalasi

```bash
# 1. Buat proyek Laravel baru
composer create-project laravel/laravel klinikku
cd klinikku

# 2. Install Breeze (Blade stack) untuk autentikasi
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build

# 3. Install Spatie Permission
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# 4. Salin seluruh isi folder ini ke proyek (timpa file yang sama)
#    - app/Models, app/Http/Controllers, app/Http/Requests
#    - database/migrations, database/seeders
#    - resources/views
#    - routes/web.php, routes/api.php

# 5. Tambahkan HasRoles ke model User (sudah termasuk di app/Models/User.php)

# 6. Konfigurasi database di .env, lalu jalankan migration & seeder
php artisan migrate --seed

# 7. Jalankan server
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

## Akun Default (dari seeder)
| Email | Password | Role |
|---|---|---|
| admin@example.com | password | admin |
| staff@example.com | password | staff |

- **Admin**: akses penuh ke semua modul, termasuk kelola data Dokter.
- **Staff**: bisa kelola Pasien, Jadwal, Antrian, Rekam Medis. Data Dokter
  hanya bisa dilihat (read-only), tidak bisa tambah/edit/hapus.

## Dokumentasi REST API

Base URL: `/api`

| Method | Endpoint | Keterangan |
|---|---|---|
| GET | `/api/pasien` | List pasien (paginated, `?search=`) |
| POST | `/api/pasien` | Tambah pasien baru |
| GET | `/api/pasien/{id}` | Detail satu pasien |
| PUT/PATCH | `/api/pasien/{id}` | Update pasien |
| DELETE | `/api/pasien/{id}` | Hapus pasien |
| GET | `/api/dokter` | List dokter (paginated, `?search=`) |
| POST | `/api/dokter` | Tambah dokter baru |
| GET | `/api/dokter/{id}` | Detail satu dokter |
| PUT/PATCH | `/api/dokter/{id}` | Update dokter |
| DELETE | `/api/dokter/{id}` | Hapus dokter |

Semua response berbentuk JSON dengan format:
```json
{ "success": true, "data": { ... } }
```

> Catatan: endpoint API ini belum diberi proteksi token (Sanctum) agar mudah
> diuji saat demo. Untuk produksi, tambahkan middleware `auth:sanctum` pada
> route di `routes/api.php`.

## Struktur Database (Entitas Utama)
- **pasiens** — data pasien (nama, NIK, tanggal lahir, jenis kelamin, alamat, no telepon)
- **dokters** — data dokter (nama, spesialisasi, no telepon)
- **jadwal_pemeriksaans** — jadwal kunjungan (pasien, dokter, tanggal, waktu, keluhan, status)
- **antrians** — nomor antrian harian (nomor, pasien, dokter, status, waktu daftar)
- **rekam_medis** — riwayat diagnosis (pasien, dokter, tanggal, diagnosis, resep, catatan)

## Lesson Learned / Catatan Bug
_(Lengkapi bagian ini sebelum submit sesuai pengalaman kelompok kalian.)_
- Tantangan yang dihadapi: ...
- Solusi yang ditempuh: ...
- Bug yang diketahui: ...

## Tim
- Nama Anggota 1 — NIM — Peran
- Nama Anggota 2 — NIM — Peran
- Nama Anggota 3 — NIM — Peran
