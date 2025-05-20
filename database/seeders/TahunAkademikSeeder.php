<?php

namespace Database\Seeders;

use App\Models\TahunAkademik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAkademik::create([
            'tahun_akademik' => '2025/2026',
            'semester' => 'Ganjil',
        ]);

        TahunAkademik::create([
            'tahun_akademik' => '2025/2026',
            'semester' => 'Genap',
        ]);
    }
}
