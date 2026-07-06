<?php

namespace App\Http\Controllers;

use App\Http\Requests\AntrianRequest;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;

class AntrianController extends Controller
{
    public function index()
    {
        $status = request('status');

        $antrians = Antrian::with(['pasien', 'dokter'])
            ->whereDate('tanggal', today())
            ->when($status && $status !== 'semua', fn ($q) => $q->where('status', $status))
            ->orderBy('nomor_antrian')
            ->paginate(10)
            ->withQueryString();

        $antrianAktif = Antrian::with(['pasien', 'dokter'])
            ->whereDate('tanggal', today())
            ->where('status', 'dipanggil')
            ->latest()
            ->first();

        return view('antrian.index', compact('antrians', 'antrianAktif', 'status'));
    }

    public function create()
    {
        $pasiens = Pasien::orderBy('nama')->get();
        $dokters = Dokter::orderBy('nama')->get();

        return view('antrian.create', compact('pasiens', 'dokters'));
    }

    public function store(AntrianRequest $request)
    {
        $nomorUrut = DB::transaction(function () {
            $terakhir = Antrian::whereDate('tanggal', today())->count();

            return $terakhir + 1;
        });

        Antrian::create([
            'nomor_antrian' => 'A'.str_pad($nomorUrut, 3, '0', STR_PAD_LEFT),
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'tanggal' => today(),
            'status' => 'menunggu',
            'waktu_daftar' => now()->format('H:i:s'),
        ]);

        return redirect()->route('antrian.index')->with('success', 'Nomor antrian berhasil diambil.');
    }

    public function updateStatus(Antrian $antrian, string $status)
    {
        $antrian->update(['status' => $status]);

        return back()->with('success', 'Status antrian berhasil diperbarui.');
    }

    public function destroy(Antrian $antrian)
    {
        $antrian->delete();

        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus.');
    }
}
