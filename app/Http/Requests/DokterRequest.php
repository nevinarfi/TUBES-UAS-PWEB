<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
        return [
            'nama' => ['required', 'string', 'max:255'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],

            'hari_praktik' => ['required', 'array', 'min:1'],
            'hari_praktik.*' => [
                'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu'
            ],
        ];
    }
}