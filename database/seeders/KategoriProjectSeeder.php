<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = Kategori::get();
        $project = Project::get();

        foreach ($project as $item) {
            $item->kategori()->attach($kategori->random());
        }
    }
}
