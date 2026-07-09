<?php

use App\Http\Controllers\AntrianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/live', [DashboardController::class, 'live'])->name('dashboard.live');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Pasien: bisa diakses admin & staff
        Route::resource('pasien', PasienController::class);

        // Jadwal Pemeriksaan: bisa diakses admin & staff
        Route::resource('jadwal', JadwalController::class)->except(['show']);

        // Antrian: bisa diakses admin & staff
        Route::get('antrian', [AntrianController::class, 'index'])->name('antrian.index');
        Route::get('antrian/create', [AntrianController::class, 'create'])->name('antrian.create');
        Route::post('antrian', [AntrianController::class, 'store'])->name('antrian.store');
        Route::patch('antrian/{antrian}/status/{status}', [AntrianController::class, 'updateStatus'])->name('antrian.status');
        Route::delete('antrian/{antrian}', [AntrianController::class, 'destroy'])->name('antrian.destroy');

        // Rekam Medis: bisa diakses admin & staff
        Route::get('rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
        Route::get('rekam-medis/create', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
        Route::post('rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
        Route::get('rekam-medis/{rekamMedi}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');
        Route::delete('rekam-medis/{rekamMedi}', [RekamMedisController::class, 'destroy'])->name('rekam-medis.destroy');

        // Dokter: index & show untuk semua, create/edit/delete khusus admin
        Route::get('dokter', [DokterController::class, 'index'])->name('dokter.index');

        Route::middleware('role:admin')->group(function () {
            Route::get('dokter/create', [DokterController::class, 'create'])->name('dokter.create');
            Route::post('dokter', [DokterController::class, 'store'])->name('dokter.store');
            Route::get('dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
            Route::put('dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
            Route::delete('dokter/{dokter}', [DokterController::class, 'destroy'])->name('dokter.destroy');
        });
    });
});

require __DIR__.'/auth.php';
