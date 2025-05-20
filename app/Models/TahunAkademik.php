<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_akademik',
        'semester',
        'is_active'
    ];

    protected $table = 'm_tahun_akademik';

    public static function generateFutureYears()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $yearsToGenerate = 3;

        // Nonaktifkan semua tahun terlebih dahulu
        self::query()->update(['is_active' => false]);

        for ($i = 0; $i < $yearsToGenerate; $i++) {
            $year1 = $currentYear + $i;
            $year2 = $year1 + 1;
            $tahunAkademik = "$year1/$year2";

            // Tentukan semester aktif berdasarkan bulan saat ini
            $activeSemester = ($currentMonth >= 8 || $i > 0) ? 'Ganjil' : 'Genap';

            // Gunakan updateOrCreate untuk menghindari duplikasi
            self::updateOrCreate(
                ['tahun_akademik' => $tahunAkademik, 'semester' => 'Ganjil'],
                ['is_active' => ($activeSemester === 'Ganjil' && $i === 0)]
            );

            self::updateOrCreate(
                ['tahun_akademik' => $tahunAkademik, 'semester' => 'Genap'],
                ['is_active' => ($activeSemester === 'Genap' && $i === 0)]
            );
        }
    }
}
