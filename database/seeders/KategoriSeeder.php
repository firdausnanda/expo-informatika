<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori::factory()->count(10)->create();
        Kategori::create([
            'nama' => 'Web Development',
            'slug' => 'web-development',
            'deskripsi' => 'Web Development',
        ]);

        Kategori::create([
            'nama' => 'Mobile Development',
            'slug' => 'mobile-development',
            'deskripsi' => 'Mobile Development',
        ]);

        Kategori::create([
            'nama' => 'Game Development',
            'slug' => 'game-development',
            'deskripsi' => 'Game Development',
        ]);

        Kategori::create([
            'nama' => 'Machine Learning',
            'slug' => 'machine-learning',
            'deskripsi' => 'Machine Learning',
        ]);

        Kategori::create([
            'nama' => 'Data Science',
            'slug' => 'data-science',
            'deskripsi' => 'Data Science',
        ]);

        Kategori::create([
            'nama' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'deskripsi' => 'Artificial Intelligence',
        ]);
        
        Kategori::create([
            'nama' => 'Cybersecurity',
            'slug' => 'cybersecurity',
            'deskripsi' => 'Cybersecurity',
        ]);

        Kategori::create([
            'nama' => 'Network',
            'slug' => 'network',
            'deskripsi' => 'Network',
        ]);

        Kategori::create([
            'nama' => 'Database Management',
            'slug' => 'database-management',
            'deskripsi' => 'Database Management',
        ]);

        Kategori::create([
            'nama' => 'Cloud Computing',
            'slug' => 'cloud-computing',
            'deskripsi' => 'Cloud Computing',
        ]);

        Kategori::create([
            'nama' => 'DevOps',
            'slug' => 'devops',
            'deskripsi' => 'DevOps',
        ]);
        
        
    }
}
