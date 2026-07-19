<?php

namespace Database\Factories;

use App\Models\Dokter;
use App\Models\JadwalPemeriksaan;
use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalPemeriksaanFactory extends Factory
{
    protected $model = JadwalPemeriksaan::class;

    public function definition(): array
    {
        return [
            'pasien_id' => Pasien::inRandomOrder()->value('id'),
            'dokter_id' => Dokter::inRandomOrder()->value('id'),
            'tanggal' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'waktu' => fake()->time('H:i:s'),
            'keluhan' => fake()->sentence(),
            'status' => fake()->randomElement([
                'terjadwal',
                'selesai',
            ]),
        ];
    }
}