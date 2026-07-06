<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasienRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pasienId = $this->route('pasien')?->id;

        return [
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:20', Rule::unique('pasiens', 'nik')->ignore($pasienId)],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
        ];
    }
}
