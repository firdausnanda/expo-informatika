<?php

namespace Database\Factories;

use App\Models\Matakuliah;
use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $matakuliah = Matakuliah::all();
        $tahunAkademik = TahunAkademik::all();
        
        return [
            'nama' => $this->faker->name,
            'slug' => $this->faker->slug,
            'deskripsi' => $this->faker->sentence,
            'link' => $this->faker->url,
            'status' => $this->faker->boolean,
            'id_matakuliah' => $matakuliah->random()->id,
            'id_tahun_akademik' => $tahunAkademik->random()->id,
        ];
    }
}
