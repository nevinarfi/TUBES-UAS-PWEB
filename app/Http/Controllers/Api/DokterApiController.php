<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterApiController extends Controller
{
    public function index()
    {
        $dokters = Dokter::when(request('search'), function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $dokters,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
        ]);

        $dokter = Dokter::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil dibuat.',
            'data' => $dokter,
        ], 201);
    }

    public function show(Dokter $dokter)
    {
        return response()->json([
            'success' => true,
            'data' => $dokter,
        ]);
    }

    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama' => ['sometimes', 'string', 'max:255'],
            'spesialisasi' => ['sometimes', 'string', 'max:255'],
            'no_telepon' => ['sometimes', 'string', 'max:20'],
        ]);

        $dokter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil diperbarui.',
            'data' => $dokter,
        ]);
    }

    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokter berhasil dihapus.',
        ]);
    }
}
