<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreProject;
use App\Http\Requests\Admin\Project\StoreProjectGambar;
use App\Models\GambarProject;
use App\Models\Kategori;
use App\Models\Project;
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

            $project = Project::create([
                'nama' => $request->nama,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link
            ]);

            $project->kategori()->attach($request->kategori);

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
        $project = Project::with('kategori', 'gambar')->find($id);
        if (!$project) {
            return ResponseFormatter::error('Data tidak ditemukan', 'Data tidak ditemukan', 404);
        }
        return view('pages.admin.project.edit', compact('project', 'kategori'));
    }

    public function update(Request $request)
    {
        try {
            $slug = Str::slug($request->nama);
            $project = Project::find($request->id);
            $project->update([
                'nama' => $request->nama,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link
            ]);

            $project->kategori()->sync($request->kategori);

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
                    }else{
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
}
