<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pasien_id' => ['required', 'exists:pasiens,id'],
            'dokter_id' => ['required', 'exists:dokters,id'],
            'tanggal' => ['required', 'date'],
            'waktu' => ['required'],
            'keluhan' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['terjadwal', 'selesai', 'batal'])],
        ];
    }
}
