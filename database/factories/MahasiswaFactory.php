<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name,
            'nim' => $this->faker->unique()->randomNumber(8),
            'prodi' => 'Informatika',
            'angkatan' => $this->faker->randomElement(['2020', '2021', '2022', '2023', '2024']),
        ];
    }
}
