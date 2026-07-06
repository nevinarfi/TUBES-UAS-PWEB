<?php

namespace App\Http\Controllers;

use App\Http\Requests\RekamMedisRequest;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pasien', 'dokter'])
            ->when(request('search'), function ($query, $search) {
                $query->whereHas('pasien', fn ($q) => $q->where('nama', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('rekam_medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $pasiens = Pasien::orderBy('nama')->get();
        $dokters = Dokter::orderBy('nama')->get();

        return view('rekam_medis.create', compact('pasiens', 'dokters'));
    }

    public function store(RekamMedisRequest $request)
    {
        RekamMedis::create($request->validated());

        return redirect()->route('rekam-medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show(RekamMedis $rekamMedi)
    {
        $rekamMedi->load(['pasien', 'dokter']);

        return view('rekam_medis.show', ['rekamMedis' => $rekamMedi]);
    }

    public function destroy(RekamMedis $rekamMedi)
    {
        $rekamMedi->delete();

        return redirect()->route('rekam-medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }
}
