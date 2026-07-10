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

| No | Nama | NIM 
|---|---|---|---|---|
| 1 | Faiz Azzikri| 230102044|  
| 2 | Muhammad Fadil Rizki| 230102085 | 
| 3 |M Firdausa Arfiandi Np |230102074 | 
| 4 | Muhammad Rizqy Subagja | 230102095| 

---

## 2. Ringkasan Target Checkpoint 1

Sesuai jadwal bimbingan, target yang harus selesai di checkpoint ini:

- [ ☑ ] Setup project Laravel 13 + Breeze + Spatie Permission
- [ ☑ ] Struktur database (ERD) sudah dirancang
- [ ☑ ] Migration seluruh entitas sudah dibuat
- [ ☑ ] Autentikasi (Login, Register, Logout) sudah berjalan
- [ ☑ ] Role Admin & Staff sudah dikonfigurasi
- [ ☑ ] Repository GitHub sudah dibuat, branch `main` terisi starter project

---

## 3. Progress per Anggota

> Setiap anggota wajib mengisi bagian ini sendiri-sendiri sebelum bimbingan, supaya kontribusi masing-masing terlihat jelas.

### Anggota 1 — _(M Firdausa Arfiandi Np)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☑ Selesai |
| Kendala yang dihadapi | mungkin sebisanya kalau ada bug sebisa mungkin akan di benerin|
| Rencana selanjutnya | tidak ada karena udh puas|

### Anggota 2 — _(Muhammad Fadil Rizki)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | Implementasi CRUD Pasien (Controller, Request, View) |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☑ Selesai |
| Kendala yang dihadapi | Sempat bingung di validasi form untuk data unik, tapi sudah bisa. |
| Rencana selanjutnya | Membantu pengerjaan Dashboard di Checkpoint 2 |

### Anggota 3 — _(Faiz Azzikri)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☑ Selesai |
| Kendala yang dihadapi | Saat clone tidak bisa dapat verifikasi mailtrap, alhamdulillah sudah bisa |
| Rencana selanjutnya | Membantu pengerjaan Checkpoint revisi |

### Anggota 4 — _(Nama)_

| Item | Detail |
|---|---|
| Tugas yang dikerjakan | |
| Status | ☐ Belum mulai ☐ Sedang berjalan ☐ Selesai |
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

| Tanggal | Waktu | Nama | Aktivitas | Branch / Commit |
|---|---|---|---|---|
| 8 Juli 2026 | 10.00 | Fadil | Buat `PasienController` & `PasienRequest` untuk validasi | `feature/crud-pasien` |
| 8 Juli 2026 | 13.00 | Fadil | Buat view index, create, dan edit untuk data Pasien | `feature/crud-pasien` |
| 9 Juli 2026 | 09.00 | Fadil | Implementasi fungsi store, update, destroy di Controller | `feature/crud-pasien` |
| 9 Juli 2026 | 14.00 | Fadil | Tambahkan fitur search & pagination pada tabel pasien | `feature/crud-pasien` |
| 10 Juli 2026 | 09.00 | Fadil | Integrasi CRUD Dokter (mengikuti pola CRUD Pasien) | `feature/crud-dokter` |

| Tanggal | Waktu | Nama | Aktivitas | Branch / Commit |
| 11 Juli 2026 | 23.30 | Faiz | Install & konfigurasi **Spatie Laravel Permission**, verifikasi package dan middleware role pada project                                             | `feature/role-permission` |

| 11 Juli 2026 | 00.30 | Faiz | Membuat `RolePermissionSeeder` berisi role **admin** dan **staff** beserta 19 permission sistem                                                      | `feature/role-permission` |

| 11 Juli 2026 | 2.30 | Faiz | Integrasi `RolePermissionSeeder` ke `DatabaseSeeder`, assign role pada akun demo (`admin@example.com` & `staff@example.com`)                         | `feature/role-permission` |

| 11 Juli 2026 | 3.00 | Faiz | Verifikasi implementasi Role & Permission menggunakan Laravel Tinker serta pengecekan role dan permission pada database                              | `feature/role-permission` |

| 11 Juli 2026 | 04.30 | Faiz | Revisi menu **Data Pasien**: meningkatkan pagination dari 10 menjadi **50 data** per halaman dan merapikan query pencarian                           | `feature/crud-pasien`     |

| 11 Juli 2026 | 04.50 | Faiz | Membuat `PasienFactory` dan menambahkan **120 data dummy pasien** untuk kebutuhan pengujian pagination dan pencarian                                 | `feature/seeder`          |

| 11 Juli 2026 | 06.00 | Faiz | Revisi menu **Data Dokter**: menambahkan **dropdown filter spesialisasi** yang dapat dikombinasikan dengan fitur pencarian                           | `feature/crud-dokter`     |

| 11 Juli 2026 | 06.45 | Faiz | Membuat `DokterFactory` dan menambahkan **60 data dummy dokter** untuk pengujian filter dan pagination                                               | `feature/seeder`          |

| 11 Juli 2026 | 06.45 | Faiz | Mengubah pagination menu **Data Dokter** menjadi **50 data** per halaman serta mempertahankan parameter filter menggunakan `withQueryString()`       | `feature/crud-dokter`     |

| 11 Juli 2026 | 06.45 | Faiz | Review dan penyesuaian implementasi Role & Permission pada tampilan (Blade) menggunakan directive `@role` untuk membatasi menu dan aksi khusus admin | `feature/role-permission` |

| | | | | |

---

## 5. ERD (Entity Relationship Diagram)



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

*Laporan ini diperbarui terakhir pada: _(11/07/2026)_ oleh _(FaizAzzikri)_*
