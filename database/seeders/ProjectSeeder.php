<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = Mahasiswa::all();
        $projects = Project::factory()->count(250)->create();
        foreach ($projects as $project) {
            $project->mahasiswa()->attach($mahasiswa->random(), ['status' => true]);
        }
    }
}
