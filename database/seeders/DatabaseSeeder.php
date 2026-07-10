<?php

namespace Database\Seeders;

use Database\Seeders\RolePermissionSeeder;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\JadwalPemeriksaan;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        // Roles
        $adminRole = Role::findByName('admin');
        $staffRole = Role::findByName('staff');

        // Users demo
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin KlinikKu', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        $staff = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            ['name' => 'Staff KlinikKu', 'password' => bcrypt('password')]
        );
        $staff->assignRole($staffRole);

        // Dokter
        $dokters = collect([
            ['nama' => 'Dr. Andi Wijaya', 'spesialisasi' => 'Dokter Umum', 'no_telepon' => '081234567890'],
            ['nama' => 'Dr. Siti Rahma', 'spesialisasi' => 'Dokter Anak', 'no_telepon' => '081234567891'],
            ['nama' => 'Dr. Budi Santoso', 'spesialisasi' => 'Dokter Gigi', 'no_telepon' => '081234567892'],
        ])->map(fn ($d) => Dokter::firstOrCreate(['nama' => $d['nama']], $d));
        // Tambah 60 dokter dummy
        Dokter::factory(60)->create();

        // Pasien
        $pasiens = collect([
            ['nama' => 'Rina Wulandari', 'nik' => '3201010101010001', 'tanggal_lahir' => '1995-05-10', 'jenis_kelamin' => 'Perempuan', 'alamat' => 'Jl. Merdeka No. 1, Bandung', 'no_telepon' => '081211110001'],
            ['nama' => 'Joko Prasetyo', 'nik' => '3201010101010002', 'tanggal_lahir' => '1988-11-22', 'jenis_kelamin' => 'Laki-laki', 'alamat' => 'Jl. Asia Afrika No. 5, Bandung', 'no_telepon' => '081211110002'],
            ['nama' => 'Dewi Lestari', 'nik' => '3201010101010003', 'tanggal_lahir' => '2001-02-14', 'jenis_kelamin' => 'Perempuan', 'alamat' => 'Jl. Dago No. 12, Bandung', 'no_telepon' => '081211110003'],
        ])->map(fn ($p) => Pasien::firstOrCreate(['nik' => $p['nik']], $p));
        // Tambahkan 120 pasien dummy
        Pasien::factory(120)->create();

        // Jadwal
        JadwalPemeriksaan::firstOrCreate([
            'pasien_id' => $pasiens[0]->id,
            'dokter_id' => $dokters[0]->id,
            'tanggal' => today(),
        ], [
            'waktu' => '09:00',
            'keluhan' => 'Demam dan batuk selama 3 hari',
            'status' => 'terjadwal',
        ]);

        // Antrian
        Antrian::firstOrCreate([
            'nomor_antrian' => 'A001',
            'tanggal' => today(),
        ], [
            'pasien_id' => $pasiens[0]->id,
            'dokter_id' => $dokters[0]->id,
            'status' => 'menunggu',
            'waktu_daftar' => now()->format('H:i:s'),
        ]);

        // Rekam Medis
        RekamMedis::firstOrCreate([
            'pasien_id' => $pasiens[1]->id,
            'dokter_id' => $dokters[1]->id,
            'tanggal' => now()->subDays(3),
        ], [
            'diagnosis' => 'ISPA ringan',
            'resep' => 'Paracetamol 3x500mg, Vitamin C 1x1',
            'catatan' => 'Kontrol kembali jika demam tidak turun dalam 3 hari',
        ]);
    }
}
