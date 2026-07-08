# Laporan Progress — Checkpoint 1

**Proyek:** KlinikKu — Sistem Pendaftaran Pasien Klinik
**Mata Kuliah:** Pemrograman Web Berbasis Framework
**Target Checkpoint 1:** Setup project, ERD, autentikasi
**Tanggal Checkpoint 1 (Kelas B):** 7 Juli 2026

> Jadwal lengkap Kelas B sesuai PPT — Checkpoint 2: 10 Juli 2026 (CRUD pertama selesai), Checkpoint 3: 14 Juli 2026 (Role & Permission + Dashboard draft), Checkpoint 4: 17 Juli 2026 (semua fitur lengkap, siap demo).

---

## 1. Identitas Kelompok

| Keterangan | Isi |
|---|---|
| Nama Kelompok | _(Klinikku)_ |
| Kelas | B |
| Dosen Pembimbing | _( Dina Budhi Utami S.Kom, M.T.)_ |
| Tema Proyek | KlinikKu — Sistem Pendaftaran Pasien Klinik |
| Repository GitHub | _(https://github.com/nevinarfi/TUBES-UAS-PWEB)_ |

### Daftar Anggota

| No | Nama | NIM | Peran Utama | Kontak |
|---|---|---|---|---|
| 1 | | | Ketua / Backend | |
| 2 | | | Frontend / UI | |
| 3 | | | Database / API | |
| 4 | | | QA / Dokumentasi | |

---

## 2. Ringkasan Target Checkpoint 1

Sesuai jadwal bimbingan, target yang harus selesai di checkpoint ini:

- [ ] Setup project Laravel 13 + Breeze + Spatie Permission
- [ ] Struktur database (ERD) sudah dirancang
- [ ] Migration seluruh entitas sudah dibuat
- [ ] Autentikasi (Login, Register, Logout) sudah berjalan
- [ ] Role Admin & Staff sudah dikonfigurasi
- [ ] Repository GitHub sudah dibuat, branch `main` terisi starter project

---

## 3. Progress per Anggota

> Setiap anggota wajib mengisi bagian ini sendiri-sendiri sebelum bimbingan, supaya kontribusi masing-masing terlihat jelas.

### Anggota 1 — _(Nama)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☐ Selesai |
| Commit terkait | `git log --author="nama"` → tempel hash/link commit |
| Kendala yang dihadapi | |
| Rencana selanjutnya | |

### Anggota 2 — _(Nama)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☐ Selesai |
| Commit terkait | |
| Kendala yang dihadapi | |
| Rencana selanjutnya | |

### Anggota 3 — _(Nama)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☐ Selesai |
| Commit terkait | |
| Kendala yang dihadapi | |
| Rencana selanjutnya | |

### Anggota 4 — _(Nama)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☐ Selesai |
| Commit terkait | |
| Kendala yang dihadapi | |
| Rencana selanjutnya | |

---

## 4. Log Aktivitas Kelompok

> Isi setiap kali ada progres, sekecil apa pun. Ini jadi bukti kontribusi merata untuk penilaian "Git Workflow" dan "Bimbingan & Progress".

| Tanggal | Waktu | Nama | Aktivitas | Branch / Commit |
|---|---|---|---|---|
| 4 Juli 2026 | 09.00 |arfi | Buat project baru: `composer create-project laravel/laravel klinikku` | `main` |
| 4 Juli 2026 | 09.30 | arfi | Install Laravel Breeze (Blade stack): `composer require laravel/breeze --dev` lalu `php artisan breeze:install blade` | `main` |
| 4 Juli 2026 | 10.15 |arfi  | Install & publish package Spatie Permission: `composer require spatie/laravel-permission`, publish migration & config | `feature/setup-project` |
| 4 Juli 2026 | 11.00 | arfi | Konfigurasi `.env` (nama app, koneksi database MySQL `klinikku`) | `feature/setup-project` |
| 4 Juli 2026 | 13.00 | arfi | Rancang ERD: entitas `pasiens`, `dokters`, `jadwal_pemeriksaans`, `antrians`, `rekam_medis` beserta relasinya | — (diskusi tim) |
| 5 Juli 2026 | 09.00 |arfi  | Buat migration untuk 5 entitas utama sesuai ERD | `feature/migration-entities` |
| 5 Juli 2026 | 10.30 | arfi | Buat model Eloquent (`Pasien`, `Dokter`, `JadwalPemeriksaan`, `Antrian`, `RekamMedis`) beserta relasi `hasMany`/`belongsTo` | `feature/models` |
| 5 Juli 2026 | 11.30 | arfi | Tambahkan trait `HasRoles` ke model `User` supaya terhubung dengan Spatie Permission | `feature/role-permission` |
| 5 Juli 2026 | 13.30 | arfi | Buat `DatabaseSeeder` + seed role `admin` & `staff`, akun demo, dan data contoh pasien/dokter | `feature/seeder` |
| 5 Juli 2026 | 14.15 | arfi | Jalankan `php artisan migrate --seed`, verifikasi tabel & data masuk ke database | `feature/seeder` |
| 5 Juli 2026 | 15.00 |arfi  | Uji coba halaman Register & Login bawaan Breeze — berhasil membuat akun & login | `feature/auth-breeze` |
| 6 Juli 2026 | 09.00 |arfi  | Setup middleware `role:admin` di `routes/web.php` untuk membatasi akses modul Dokter | `feature/role-permission` |
| 6 Juli 2026 | 10.00 | arfi | Desain layout utama (sidebar, dashboard) di `resources/views/components/app-layout.blade.php` | `feature/ui-layout` |
| 6 Juli 2026 | 16.00 |arfi  | **Debug:** sidebar custom tidak muncul — ternyata tertimpa oleh class `App\View\Components\AppLayout.php` bawaan Breeze yang mengarah ke `layouts.app` lama | `feature/ui-layout` |
| 6 Juli 2026 | 17.30 | arfi | **Fix:** hapus `app/View/Components/AppLayout.php`, jalankan `composer dump-autoload` supaya `<x-app-layout>` memakai layout baru | `feature/ui-layout` |
| 7 Juli 2026 | 09.00 | arfi | Buat `GuestLayout.php` (khusus halaman login/register) supaya tidak error setelah fix di atas | `feature/ui-layout` |
| 7 Juli 2026 | 10.00 | arfi | Verifikasi akhir: login sebagai `admin@example.com` & `staff@example.com`, pastikan dashboard tampil dengan sidebar & data statistik sesuai role | `feature/auth-breeze` |
| | | | | |

---

## 5. ERD (Entity Relationship Diagram)

_(Tempel gambar/screenshot ERD kalian di sini, atau link ke Draw.io / Miro / dbdiagram.io)_

**Entitas utama:**
- `users` — akun login (relasi ke role via Spatie: admin, staff)
- `pasiens` — data pasien
- `dokters` — data dokter
- `jadwal_pemeriksaans` — jadwal kunjungan (relasi ke pasien & dokter)
- `antrians` — nomor antrian harian (relasi ke pasien & dokter)
- `rekam_medis` — riwayat diagnosis (relasi ke pasien & dokter)

```
users ─┬─ (role: admin/staff via Spatie)
        
pasiens ─┬── jadwal_pemeriksaans ──┬── dokters
         ├── antrians ─────────────┤
         └── rekam_medis ──────────┘
```

---

## 6. Bukti Autentikasi Berjalan

_(Tempel screenshot di sini)_

- [ ] Screenshot halaman Login
- [ ] Screenshot halaman Register
- [ ] Screenshot setelah berhasil login (dashboard)
- [ ] Screenshot akun dengan role Admin vs Staff (perbedaan akses)

---

## 7. Kendala & Solusi

| Kendala | Solusi / Status |
|---|---|
| Tampilan halaman blank/tidak ada styling sama sekali setelah copy view baru | Ternyata Tailwind (via Vite) belum ter-build; solusi sementara pakai Tailwind CDN langsung di layout supaya styling pasti tampil tanpa perlu `npm run build` |
| Sidebar custom tidak pernah muncul, selalu balik ke tampilan nav bawaan Breeze | `<x-app-layout>` ternyata diprioritaskan ke class `App\View\Components\AppLayout.php` (bawaan Breeze) yang hard-code `return view('layouts.app')`. Solusi: hapus file class tersebut + `composer dump-autoload` agar Laravel pakai anonymous component di `resources/views/components/app-layout.blade.php` |
| Error `Unable to locate a class or view for component [guest-layout]` setelah hapus file di atas | Ikut terhapus `GuestLayout.php` yang masih dipakai halaman login/register. Solusi: buat ulang file tersebut, arahkan ke `layouts.guest` (belum dikustom) |
| Error `include(...AppLayout.php): Failed to open stream` | Cache autoload Composer (classmap) belum diperbarui setelah file dihapus. Solusi: `composer dump-autoload` |
| | |
| | |

---

## 8. Rencana Checkpoint Berikutnya (Checkpoint 2)

Target: **Fitur CRUD pertama selesai**

- [ ] CRUD Pasien selesai (Create, Read, Update, Delete + search & pagination)
- [ ] CRUD Dokter selesai
- [ ] Form validasi berjalan dengan baik
- [ ] Review bersama sebelum bimbingan berikutnya

---

*Laporan ini diperbarui terakhir pada: _(tanggal)_ oleh _(nama)_*