<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
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
        return view('dashboard', $this->buildDashboardData());
    }

    /**
     * Endpoint JSON ringan untuk auto-refresh panel antrian (dipoll via fetch()
     * setiap beberapa detik dari dashboard.blade.php), tanpa reload halaman penuh.
     */
    public function live()
    {
        return response()->json($this->buildQueueData());
    }

    /**
     * Data untuk bagian antrian yang bersifat real-time:
     * antrian yang sedang dipanggil + daftar antrian berikutnya.
     */
    private function buildQueueData(): array
    {
        $antrianAktif = Antrian::with(['pasien', 'dokter'])
            ->whereDate('tanggal', today())
            ->where('status', 'dipanggil')
            ->latest()
            ->first();

        $antrianBerikutnya = Antrian::with(['pasien', 'dokter'])
            ->whereDate('tanggal', today())
            ->where('status', 'menunggu')
            ->orderBy('nomor_antrian')
            ->take(5)
            ->get();

        $antrianMenunggu = Antrian::whereDate('tanggal', today())->where('status', 'menunggu')->count();
        $antrianDipanggil = Antrian::whereDate('tanggal', today())->where('status', 'dipanggil')->count();
        $antrianSelesai = Antrian::whereDate('tanggal', today())->where('status', 'selesai')->count();

        return [
            'antrian_aktif' => $antrianAktif ? [
                'nomor_antrian' => $antrianAktif->nomor_antrian,
                'pasien' => $antrianAktif->pasien->nama,
                'dokter' => $antrianAktif->dokter->nama,
            ] : null,
            'antrian_berikutnya' => $antrianBerikutnya->map(fn ($a) => [
                'nomor_antrian' => $a->nomor_antrian,
                'pasien' => $a->pasien->nama,
                'dokter' => $a->dokter->nama,
            ]),
            'jumlah_menunggu' => $antrianMenunggu,
            'jumlah_dipanggil' => $antrianDipanggil,
            'jumlah_selesai' => $antrianSelesai,
            'updated_at' => now()->format('H:i:s'),
        ];
    }

    private function buildDashboardData(): array
    {
        $queue = $this->buildQueueData();

        $pasienBaruHariIni = Pasien::whereDate('created_at', today())->count();
        $jadwalHariIni = JadwalPemeriksaan::whereDate('tanggal', today())->count();
        $totalPasien = Pasien::count();
        $totalDokter = Dokter::count();

        // Dokter bertugas hari ini: dokter yang punya jadwal periksa hari ini,
        // lengkap dengan jumlah pasien terjadwal (dipakai sebagai indikator beban/kuota).
        $dokterBertugasHariIni = Dokter::withCount([
            'jadwalPemeriksaans as jadwal_hari_ini_count' => fn ($q) => $q->whereDate('tanggal', today()),
        ])
            ->having('jadwal_hari_ini_count', '>', 0)
            ->orderByDesc('jadwal_hari_ini_count')
            ->get();

        $rekamMedisTerbaru = RekamMedis::with(['pasien', 'dokter'])
            ->latest()
            ->take(5)
            ->get();

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

        $jadwalKalender = JadwalPemeriksaan::with(['pasien','dokter'])
        ->orderBy('tanggal')
        ->get()
        ->groupBy(function ($item) {
            return $item->tanggal->format('Y-m-d');
        });

        return [
            'jadwalKalender' => $jadwalKalender,
            'totalPasien' => $totalPasien,
            'totalDokter' => $totalDokter,
            'jadwalHariIni' => $jadwalHariIni,
            'pasienBaruHariIni' => $pasienBaruHariIni,
            'antrianMenunggu' => $queue['jumlah_menunggu'],
            'antrianDipanggil' => $queue['jumlah_dipanggil'],
            'antrianSelesai' => $queue['jumlah_selesai'],
            'antrianAktif' => $queue['antrian_aktif'],
            'antrianBerikutnya' => $queue['antrian_berikutnya'],
            'dokterBertugasHariIni' => $dokterBertugasHariIni,
            'rekamMedisTerbaru' => $rekamMedisTerbaru,
            'trenBulanan' => $trenBulanan,
        ];
    }
}
