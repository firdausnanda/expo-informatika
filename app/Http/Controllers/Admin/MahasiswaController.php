<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Mahasiswa\StoreMahasiswa;
use App\Http\Requests\Admin\Mahasiswa\UpdateMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mahasiswa::all();
            return ResponseFormatter::success($data, 'Data mahasiswa berhasil diambil');
        }
        return view('pages.admin.mahasiswa.index');
    }

    public function store(StoreMahasiswa $request)
    {
        try {
            Mahasiswa::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
            ]);
            return ResponseFormatter::success(null, 'Data mahasiswa berhasil ditambahkan');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data mahasiswa gagal ditambahkan');
        }
    }

    public function update(UpdateMahasiswa $request)
    {
        try {
            $mahasiswa = Mahasiswa::find($request->id);
            $mahasiswa->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
            ]);
            return ResponseFormatter::success(null, 'Data mahasiswa berhasil diubah');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data mahasiswa gagal diubah');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $mahasiswa = Mahasiswa::find($request->id);
            $mahasiswa->delete();
            return ResponseFormatter::success(null, 'Data mahasiswa berhasil dihapus');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return ResponseFormatter::error($th->getMessage(), 'Data mahasiswa gagal dihapus');
        }
    }
}
