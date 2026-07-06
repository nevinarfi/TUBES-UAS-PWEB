<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AntrianRequest extends FormRequest
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
        ];
    }
}
