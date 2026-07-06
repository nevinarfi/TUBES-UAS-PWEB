<?php

namespace App\Http\Controllers;

use App\Http\Requests\JadwalRequest;
use App\Models\Dokter;
use App\Models\JadwalPemeriksaan;
use App\Models\Pasien;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPemeriksaan::with(['pasien', 'dokter'])
            ->when(request('search'), function ($query, $search) {
                $query->whereHas('pasien', fn ($q) => $q->where('nama', 'like', "%{$search}%"));
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $pasiens = Pasien::orderBy('nama')->get();
        $dokters = Dokter::orderBy('nama')->get();

        return view('jadwal.create', compact('pasiens', 'dokters'));
    }

    public function store(JadwalRequest $request)
    {
        JadwalPemeriksaan::create($request->validated());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pemeriksaan berhasil ditambahkan.');
    }

    public function edit(JadwalPemeriksaan $jadwal)
    {
        $pasiens = Pasien::orderBy('nama')->get();
        $dokters = Dokter::orderBy('nama')->get();

        return view('jadwal.edit', compact('jadwal', 'pasiens', 'dokters'));
    }

    public function update(JadwalRequest $request, JadwalPemeriksaan $jadwal)
    {
        $jadwal->update($request->validated());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pemeriksaan berhasil diperbarui.');
    }

    public function destroy(JadwalPemeriksaan $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal pemeriksaan berhasil dihapus.');
    }
}
