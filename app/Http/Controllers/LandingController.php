<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LandingController extends Controller
{
    public function index()
    {
        $projects = Project::with('mahasiswa', 'gambar', 'matakuliah')->get();

        // Kelompokkan data secara hierarkis: tahun -> matakuliah -> projects
        $structuredData = $projects->groupBy([
            function ($project) {
                return $project->created_at->year; // Grup pertama berdasarkan tahun
            },
            function ($project) {
                return $project->matakuliah->id; // Grup kedua berdasarkan matakuliah
            }
        ])->map(function ($yearGroup, $year) {
            // Proses setiap tahun
            return [
                'year' => $year,
                'matakuliahs' => $yearGroup->map(function ($matakuliahGroup, $matakuliahId) {
                    $firstProject = $matakuliahGroup->first();

                    // Proses setiap matakuliah dalam tahun tersebut
                    return [
                        'nama' => $firstProject->matakuliah->nama_matakuliah,
                        'projects' => $matakuliahGroup->take(4)->map(function ($project) {
                            return [
                                'id' => $project->id,
                                'nama' => $project->nama,
                                'deskripsi' => $project->deskripsi,
                                'link' => $project->link,
                                'gambar' => $project->gambar->map(function ($gambar) {
                                    return [
                                        'url' => $gambar->gambar,
                                    ];
                                })
                            ];
                        })->unique('id')->values()->toArray()
                    ];
                })->unique('nama')->values()->toArray()
            ];
        })->unique('year')->values()->toArray();

        return view('pages.landing.index', compact('structuredData'));
    }
}
