<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokterRequest;
use App\Models\Dokter;

class DokterController extends Controller
{
   public function index()
{
    $query = Dokter::query();

    // Search nama atau spesialisasi
    if (request()->filled('search')) {
        $search = request('search');

        $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('spesialisasi', 'like', "%{$search}%");
        });
    }

    // Filter spesialisasi
    if (request()->filled('spesialisasi')) {
        $query->where('spesialisasi', request('spesialisasi'));
    }

    $dokters = $query
        ->latest()
        ->paginate(50)
        ->withQueryString();

    // Ambil daftar spesialisasi unik
    $spesialisasi = Dokter::select('spesialisasi')
        ->distinct()
        ->orderBy('spesialisasi')
        ->pluck('spesialisasi');

    return view('dokter.index', compact('dokters', 'spesialisasi'));
}

    public function create()
    {
        return view('dokter.create');
    }

    public function store(DokterRequest $request)
    {
        Dokter::create($request->validated());

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(DokterRequest $request, Dokter $dokter)
    {
        $dokter->update($request->validated());

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
