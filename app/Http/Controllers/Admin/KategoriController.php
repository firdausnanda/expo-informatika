<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Kategori\StoreKategori;
use App\Http\Requests\Admin\Kategori\UpdateKategori;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::all();
            return ResponseFormatter::success($data, 'Data kategori berhasil diambil');
        }
        return view('pages.admin.kategori.index');
    }

    public function store(StoreKategori $request)
    {
        try {
            $slug = Str::slug($request->nama);
            $kategori = Kategori::create([
                'nama' => $request->nama,
                'slug' => $slug,
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($kategori, 'Data kategori berhasil ditambahkan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data kategori gagal ditambahkan');
        }

    }

    public function update(UpdateKategori $request)
    {
        try {
            $kategori = Kategori::find($request->id);
            $kategori->update([
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'deskripsi' => $request->deskripsi,
            ]);
            return ResponseFormatter::success($kategori, 'Data kategori berhasil diubah');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data kategori gagal diubah');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $kategori = Kategori::find($request->id);
            $kategori->delete();
            return ResponseFormatter::success($kategori, 'Data kategori berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data kategori gagal dihapus');
        }
    }
}
