<?php

namespace Database\Seeders;

use App\Models\Project;
use Bluemmb\Faker\PicsumPhotosProvider;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GambarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $size = [100, 200, 300, 400, 500];
        $faker->addProvider(new PicsumPhotosProvider($faker));

        $projects = Project::all();
        foreach ($projects as $project) {
            $project->gambar()->create([
                'gambar' => $faker->imageUrl($size[array_rand($size)]),
            ]);
        }
    }
}
