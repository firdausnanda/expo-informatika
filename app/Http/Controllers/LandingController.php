<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Helpers\ResponseFormatter;
use App\Models\Matakuliah;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelLike\Like;

class LandingController extends Controller
{
    public function index()
    {
        $projects = Project::with('mahasiswa', 'gambar', 'matakuliah')->get();
        if (Auth::check()) {
            $user = User::find(auth()->user()->id);
            $like = $user->likes;
        } else {
            $user = null;
            $like = null;
        }

        // Kelompokkan data secara hierarkis: tahun -> matakuliah -> projects
        $structuredData = $projects->groupBy([
            function ($project) {
                return $project->created_at->year; // Grup pertama berdasarkan tahun
            },
            function ($project) {
                return $project->matakuliah->id; // Grup kedua berdasarkan matakuliah
            }
        ])->map(function ($yearGroup, $year) use ($user) {
            // Proses setiap tahun
            return [
                'year' => $year,
                'matakuliahs' => $yearGroup->map(function ($matakuliahGroup, $matakuliahId) use ($user) {
                    $firstProject = $matakuliahGroup->first();

                    // Proses setiap matakuliah dalam tahun tersebut
                    return [
                        'id' => $firstProject->matakuliah->id,
                        'nama' => $firstProject->matakuliah->nama_matakuliah,
                        'projects' => $matakuliahGroup->take(4)->map(function ($project, $key) use ($user) {
                            return [
                                'id' => $project->id,
                                'nama' => $project->nama,
                                'deskripsi' => $project->deskripsi,
                                'link' => $project->link,
                                'likes' => $user ? $user->hasLiked($project) : false,
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

    public function detail($id)
    {
        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }
        $project = Project::with('kategori', 'mahasiswa', 'gambar', 'matakuliah')->find($id);
        $user = User::find($user_id);
        $liked = $user->hasLiked($project);
        return view('pages.landing.detail', compact('project', 'user', 'liked'));
    }

    public function moreMatakuliah($id, $tahun)
    {
        if (Auth::check()) {
            $user = User::find(auth()->user()->id);
            $like = $user->likes;
        } else {
            $user = null;
            $like = null;
        }

        $matakuliah = Matakuliah::find($id);

        $projects = Project::where('id_matakuliah', $matakuliah->id)
            ->with('gambar')
            ->where('created_at', 'like', $tahun . '%')
            ->paginate(12);

        $year = $projects->first()->created_at->year;

        return view('pages.landing.more_matakuliah', compact('matakuliah', 'projects', 'user', 'like', 'year'));
    }

    public function leaderboard(Request $request)
    {
        if ($request->ajax()) {
            ResponseFormatter::success(
                null,
                'Data berhasil diambil'
            );
        }

        $projects = Project::with('mahasiswa', 'gambar', 'matakuliah')->get();
        return view('pages.landing.leaderboard', compact('projects'));
    }
}
