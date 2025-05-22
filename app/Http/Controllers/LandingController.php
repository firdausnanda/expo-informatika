<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Helpers\ResponseFormatter;
use App\Models\Kategori;
use App\Models\Matakuliah;
use App\Models\Project;
use App\Models\TahunAkademik;
use App\Models\User;
use Carbon\Carbon;
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
            ->where('status', 1)
            ->orderBy('id_tahun_akademik', 'DESC')
            ->get();

        $result = $projects->groupBy('id_tahun_akademik')
            ->take(3)->map(function ($tahunGroups, $tahunId) use ($user) {
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
        $project = Project::with('kategori', 'mahasiswa', 'gambar', 'matakuliah')
            ->where('status', 1)
            ->find($id);

        if (!$project) {
            return redirect()->route('index')->with('error', 'Proyek tidak ditemukan');
        }


        $user = User::find($user_id);
        if ($user) {
            $liked = $user->hasLiked($project);
        } else {
            $liked = false;
        }


        views($project)->record();

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
        $projects = Project::with('mahasiswa', 'gambar', 'matakuliah')
            ->where('status', 1)
            ->withCount('likers')
            ->withCount('views')
            ->take(100)
            ->orderBy('likers_count', 'desc')
            ->get();

        if ($request->ajax()) {
            return ResponseFormatter::success(
                $projects,
                'Data berhasil diambil'
            );
        }


        return view('pages.landing.leaderboard.index', compact('projects'));
    }

    public function leaderboardMonthly(Request $request)
    {
        $getYear = date('Y');
        $tahunAkademikSelected = TahunAkademik::where('tahun_akademik', $getYear . '/' . ($getYear + 1))->first();

        $query = Project::with('mahasiswa', 'gambar', 'matakuliah')
            ->where('status', 1)
            ->withCount('likers')
            ->withCount('views')
            ->take(100)
            ->orderBy('likers_count', 'desc');

        // Cek apakah ada filter bulan yang dipilih
        if ($request->month) {
            $query->where('id_tahun_akademik', $request->month);
        } else {
            $query->where('id_tahun_akademik', $tahunAkademikSelected->id);
        }

        $result = $query->get();

        if ($request->ajax()) {

            if ($request->table) {
                return ResponseFormatter::success($result, 'Data berhasil diambil');
            }else{
                return ResponseFormatter::success([
                    'html' => view('components.top-cards', compact('result'))->render(),
                    'count' => $result->count()
                ], 'Data berhasil diambil');
            }

        }

        return view('pages.landing.leaderboard.monthly', compact('result', 'tahunAkademikSelected'));
    }

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $matakuliah = Matakuliah::where('nama_matakuliah', 'like', '%' . $request->search . '%')->get();
            return ResponseFormatter::success($matakuliah, 'Data berhasil diambil');
        }
        return view('pages.landing.history.index');
    }

    public function search(Request $request)
    {
        // Validasi input
        $request->validate([
            'search' => 'required',
        ], [
            'search.required' => 'Kata kunci pencarian proyek harus diisi',
        ]);

        // Cek apakah user sedang login
        if (Auth::check()) {
            $user = User::find(auth()->user()->id);
            $like = $user->likes;
        } else {
            $user = null;
            $like = null;
        }

        // Cari proyek berdasarkan kata kunci`
        $projects = Project::with('gambar')
            ->where(function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });

        if ($request->matkul) {
            $projects->where('id_matakuliah', $request->matkul);
        }

        if ($request->startDate) {
            $startDate = Carbon::createFromLocaleFormat('j F Y', 'id', $request->startDate)->format('Y-m-d');
            $projects->where('created_at', '>=', $startDate);
        }

        if ($request->endDate) {
            $endDate = Carbon::createFromLocaleFormat('j F Y', 'id', $request->endDate)->format('Y-m-d');
            $projects->where('created_at', '<=', $endDate);
        }
        $result = $projects->paginate(12);
        return view('pages.landing.history.history-result', compact('result', 'user', 'like'));
    }

    public function kategori($slug)
    {
        $kategori = Kategori::where('slug', $slug)->first();
        $projects = Project::with('gambar')
            ->whereHas('kategori', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id_tahun_akademik', 'desc')
            ->take(100)
            ->paginate(12);

        return view('pages.landing.view-by-kategori', compact('kategori', 'projects'));
    }

    public function matakuliah($id)
    {
        $matakuliah = Matakuliah::where('id', $id)->first();
        $projects = Project::with('gambar')
            ->where('id_matakuliah', $matakuliah->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id_tahun_akademik', 'desc')
            ->take(100)
            ->paginate(12);

        return view('pages.landing.view-by-matakuliah', compact('matakuliah', 'projects'));
    }

    public function tahunAkademik()
    {
        $tahunAkademik = TahunAkademik::orderBy('tahun_akademik', 'desc')->get();
        $getYear = date('Y');
        $tahunAkademikSelected = TahunAkademik::where('tahun_akademik', $getYear . '/' . ($getYear + 1))->first();
        return ResponseFormatter::success([
            'tahunAkademik' => $tahunAkademik,
            'tahunAkademikSelected' => $tahunAkademikSelected
        ], 'Data berhasil diambil');
    }
}
