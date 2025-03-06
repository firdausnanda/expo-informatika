<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Project\StoreProject;
use App\Http\Requests\Admin\Project\StoreProjectGambar;
use App\Models\Kategori;
use App\Models\Project;
use Illuminate\Http\Request;
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
}
