<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienApiController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::when(request('search'), function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%");
        })->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $pasiens,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:20', 'unique:pasiens,nik'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
        ]);

        $pasien = Pasien::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dibuat.',
            'data' => $pasien,
        ], 201);
    }

    public function show(Pasien $pasien)
    {
        return response()->json([
            'success' => true,
            'data' => $pasien,
        ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $validated = $request->validate([
            'nama' => ['sometimes', 'string', 'max:255'],
            'nik' => ['sometimes', 'string', 'max:20', 'unique:pasiens,nik,'.$pasien->id],
            'tanggal_lahir' => ['sometimes', 'date'],
            'jenis_kelamin' => ['sometimes', 'in:Laki-laki,Perempuan'],
            'alamat' => ['sometimes', 'string'],
            'no_telepon' => ['sometimes', 'string', 'max:20'],
        ]);

        $pasien->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil diperbarui.',
            'data' => $pasien,
        ]);
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pasien berhasil dihapus.',
        ]);
    }
}
