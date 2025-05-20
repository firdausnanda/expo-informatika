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
        if (Auth::check()) {
            $user = User::find(auth()->user()->id);
            $like = $user->likes;
        } else {
            $user = null;
            $like = null;
        }

        $projects = Project::with(['tahun_akademik', 'matakuliah'])
            ->orderBy('id_tahun_akademik', 'DESC')
            ->get();

        $result = $projects->groupBy('id_tahun_akademik')
            ->take(10)->map(function ($tahunGroups, $tahunId) use ($user) {
                return [
                    'id_tahun_akademik' => $tahunId,
                    'tahun_akademik' => $tahunGroups->first()->tahun_akademik->tahun_akademik,
                    'semester' => $tahunGroups->first()->tahun_akademik->semester,
                    'matakuliah' => $tahunGroups->groupBy('id_matakuliah')->map(function ($matkulGroups, $matkulId) use ($user) {
                        return [
                            'id_matakuliah' => $matkulId,
                            'nama_matakuliah' => $matkulGroups->first()->matakuliah->nama_matakuliah,
                            'projects' => $matkulGroups->take(8)->map(function ($project) use ($user) {
                                return [
                                    'id' => $project->id,
                                    'nama' => $project->nama_project,
                                    'deskripsi' => $project->deskripsi,
                                    'link' => $project->link,
                                    'likes' => $user ? $user->hasLiked($project) : false,
                                    'gambar' => $project->gambar->map(function ($gambar) {
                                        return [
                                            'url' => $gambar->gambar,
                                        ];
                                    })
                                ];
                            })->toArray()
                        ];
                    })->values()->toArray()
                ];
            })->values()->toArray();

        return view('pages.landing.index', compact('result'));
    }

    public function detail($id)
    {
        $user_id = null;
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        }
        $project = Project::with('kategori', 'mahasiswa', 'gambar', 'matakuliah')->find($id);
        $user = User::find($user_id);
        if ($user) {
            $liked = $user->hasLiked($project);
        } else {
            $liked = false;
        }
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
            ->where('id_tahun_akademik', $tahun)
            ->with('gambar')
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
