<?php

namespace Database\Factories;

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
        return [
            'nama' => $this->faker->name,
            'slug' => $this->faker->slug,
            'deskripsi' => $this->faker->sentence,
            'link' => $this->faker->url,
            'status' => $this->faker->boolean,
        ];
    }
}
