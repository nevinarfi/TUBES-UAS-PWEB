<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\JadwalPemeriksaan;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();
        $jadwalHariIni = JadwalPemeriksaan::whereDate('tanggal', today())->count();
        $antrianMenunggu = Antrian::where('status', 'menunggu')->count();

        $antrianAktif = Antrian::with(['pasien', 'dokter'])
            ->where('status', 'dipanggil')
            ->latest()
            ->first();

        $rekamMedisTerbaru = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->take(5)
            ->get();

        // Tren pendaftaran pasien 6 bulan terakhir untuk grafik
        $trenBulanan = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $trenBulanan[] = [
                'label' => $bulan->translatedFormat('M Y'),
                'total' => Pasien::whereYear('created_at', $bulan->year)
                    ->whereMonth('created_at', $bulan->month)
                    ->count(),
            ];
        }

        return view('dashboard', compact(
            'totalPasien',
            'totalDokter',
            'jadwalHariIni',
            'antrianMenunggu',
            'antrianAktif',
            'rekamMedisTerbaru',
            'trenBulanan'
        ));
    }
}
