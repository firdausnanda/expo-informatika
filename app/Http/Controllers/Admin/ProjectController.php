<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreProject;
use App\Http\Requests\Admin\Project\StoreProjectGambar;
use App\Http\Requests\Admin\Project\UpdateProject;
use App\Models\GambarProject;
use App\Models\Kategori;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Project;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::with('kategori')->get();
            return ResponseFormatter::success($projects, 'Data berhasil diambil');
        }
        return view('pages.admin.project.index');
    }

    public function create(Request $request)
    {
        $kategori = Kategori::get();
        if ($request->ajax()) {
            return ResponseFormatter::success($kategori, 'Data berhasil diambil');
        }
        return view('pages.admin.project.create', compact('kategori'));
    }

    public function store(StoreProject $request)
    {
        try {
            $slug = Str::slug($request->nama);
            $mahasiswa_id = json_decode($request->mahasiswa_id, true);

            $project = Project::create([
                'nama' => $request->nama,
                'slug' => $slug,
                'id_tahun_akademik' => $request->tahun_akademik,
                'id_matakuliah' => $request->matakuliah,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link
            ]);

            $project->kategori()->attach($request->kategori);

            foreach ($mahasiswa_id as $key => $value) {
                $project->mahasiswa()->attach($value['id']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data project berhasil disimpan!',
                'project_id' => $project->id
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data tidak boleh kosong', 400);
        }
    }

    public function storeGambar(StoreProjectGambar $request)
    {
        try {
            $project = Project::find($request->project_id);
            $slug = $project->slug;

            // Buat folder jika belum ada
            $folderPath = 'gambar_proyek/' . $slug;
            if (!Storage::disk('public')->exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }

            foreach ($request->gambar as $key => $gambar) {
                $fileName = 'gambar-' . $key . '-' . time() . '.' . $gambar->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs($folderPath, $gambar, $fileName);
                $project->gambar()->create([
                    'gambar' => $path,
                ]);
            }

            return ResponseFormatter::success($project, 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data tidak boleh kosong', 400);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::get();
        $project = Project::with('kategori', 'gambar', 'tahun_akademik', 'mahasiswa', 'matakuliah')->find($id);
        $mahasiswa = $project->mahasiswa->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'prodi' => $item->prodi,
                'angkatan' => $item->angkatan
            ];
        })->toJson();

        if (!$project) {
            return ResponseFormatter::error('Data tidak ditemukan', 'Data tidak ditemukan', 404);
        }
        return view('pages.admin.project.edit', compact('project', 'kategori', 'mahasiswa'));
    }

    public function update(UpdateProject $request)
    {
        try {
            $slug = Str::slug($request->nama);
            $mahasiswa_id = json_decode($request->mahasiswa_id, true);

            $project = Project::find($request->id);
            $project->update([
                'nama' => $request->nama,
                'slug' => $slug,
                'id_tahun_akademik' => $request->tahun_akademik,
                'id_matakuliah' => $request->matakuliah,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link
            ]);

            $project->kategori()->sync($request->kategori);

            $project->mahasiswa()->detach();
            foreach ($mahasiswa_id as $key => $value) {
                $project->mahasiswa()->attach($value['id']);
            }

            $cache = Cache::get('delete_gambar');
            // dd($cache);
            if ($cache) {
                foreach ($cache as $value) {
                    GambarProject::where('id', $value)->delete();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data project berhasil disimpan!',
                'project_id' => $project->id
            ]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data tidak boleh kosong', 400);
        }
    }

    public function destroyGambar(Request $request)
    {
        try {
            // Store to Cache
            $cache = Cache::get('delete_gambar');
            if ($cache) {
                foreach ($cache as $key => $value) {
                    if ($value == $request->gambar_id) {
                        $cache[$key] = $request->gambar_id;
                    } else {
                        $cache[] = $request->gambar_id;
                    }
                }
                Cache::put('delete_gambar', $cache, 300);
            } else {
                Cache::put('delete_gambar', [$request->gambar_id], 300);
            }

            return ResponseFormatter::success('Data berhasil dihapus', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data tidak boleh kosong', 400);
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::find($id);
            $project->delete();
            return ResponseFormatter::success('Data berhasil dihapus', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data tidak boleh kosong', 400);
        }
    }

    public function getMahasiswaSelect(Request $request)
    {
        $search = $request->input('data');

        $mahasiswa = Mahasiswa::select('id', 'nama', 'nim', 'prodi', 'angkatan')->when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('nim', 'like', '%' . $search . '%');
        })
            ->get();

        return ResponseFormatter::success($mahasiswa, 'Data berhasil diambil');
    }

    public function getTahunAkademikSelect(Request $request)
    {
        try {
            TahunAkademik::generateFutureYears();

            $tahunAkademik = TahunAkademik::query()
                ->orderBy('tahun_akademik', 'desc')
                ->orderBy('semester', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'tahun_akademik' => $item->tahun_akademik,
                        'semester' => $item->semester,
                        'text' => $item->tahun_akademik . ' - ' . $item->semester,
                        'is_active' => $item->is_active
                    ];
                });

            return ResponseFormatter::success($tahunAkademik, 'Data tahun akademik berhasil diambil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ResponseFormatter::error([
                'error' => $e->getMessage()
            ], 'Gagal mengambil data', 500);
        }
    }

    public function getMatakuliahSelect(Request $request)
    {
        $search = $request->input('data');

        $matakuliah = Matakuliah::select('id', 'nama_matakuliah', 'kode_matakuliah')->when($search, function ($query) use ($search) {
            return $query->where('nama_matakuliah', 'like', '%' . $search . '%')
                ->orWhere('kode_matakuliah', 'like', '%' . $search . '%');
        })->get();

        return ResponseFormatter::success($matakuliah, 'Data matakuliah berhasil diambil');
    }

    public function aktif(Request $request)
    {
        $project = Project::find($request->id);

        if ($project->status == 1) {
            $project->update(['status' => 0]);
        } else {
            $project->update(['status' => 1]);
        }

        return ResponseFormatter::success('Data berhasil diubah', 'Data berhasil diubah');
    }
}
