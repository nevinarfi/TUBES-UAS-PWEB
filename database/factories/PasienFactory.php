<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'nik' => fake()->unique()->numerify('3201############'),
            'tanggal_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement([
                'Laki-laki',
                'Perempuan'
            ]),
            'alamat' => fake()->address(),
            'no_telepon' => '08' . fake()->numerify('##########'),
        ];
    }
}