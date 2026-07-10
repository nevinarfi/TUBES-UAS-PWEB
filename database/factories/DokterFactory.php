<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DokterFactory extends Factory
{
    public function definition(): array
    {
        $spesialisasi = [
            'Dokter Umum',
            'Dokter Anak',
            'Dokter Gigi',
            'Dokter Mata',
            'Dokter Kulit',
            'Dokter THT',
            'Dokter Penyakit Dalam',
            'Dokter Saraf',
            'Dokter Jantung',
            'Dokter Kandungan',
        ];

        return [
            'nama' => fake()->unique()->name(),
            'spesialisasi' => fake()->randomElement($spesialisasi),
            'no_telepon' => '08' . fake()->numerify('##########'),
        ];
    }
}