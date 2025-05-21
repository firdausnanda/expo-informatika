<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\TahunAkademik;

class MoreMatakuliahController extends Controller
{
    public function index($id_matakuliah, $id_tahun_akademik)
    {
        $matakuliah = MataKuliah::with(['projects' => function($query) use ($id_tahun_akademik) {
            $query->where('tahun_akademik_id', $id_tahun_akademik);
        }])->findOrFail($id_matakuliah);
        
        $tahun_akademik = TahunAkademik::findOrFail($id_tahun_akademik);
        
        return view('pages.more-matakuliah', compact('matakuliah', 'tahun_akademik'));
    }
} 