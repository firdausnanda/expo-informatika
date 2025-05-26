<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\ResponseFormatter;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Matakuliah::latest()->get();
            return ResponseFormatter::success($data, 'Data mata kuliah berhasil diambil');
        }
        return view('pages.admin.mata-kuliah.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_matakuliah' => 'required|string|max:20|unique:m_matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:14',
            'deskripsi' => 'nullable|string',
            'status' => 'boolean'
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah harus diisi',
            'kode_matakuliah.unique' => 'Kode mata kuliah sudah digunakan',
            'nama_matakuliah.required' => 'Nama mata kuliah harus diisi',
            'sks.required' => 'SKS harus diisi',
            'sks.integer' => 'SKS harus berupa angka',
            'sks.min' => 'SKS minimal 1',
            'sks.max' => 'SKS maksimal 6',
            'semester.required' => 'Semester harus diisi',
            'semester.integer' => 'Semester harus berupa angka',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 14'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Validasi gagal', 422);
        }

        try {
            DB::beginTransaction();
            
            $data = $request->all();
            $data['status'] = $request->has('status') ? true : false;
            
            Matakuliah::create($data);
            
            DB::commit();
            return ResponseFormatter::success(null, 'Mata kuliah berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return ResponseFormatter::error($e->getMessage(), 'Gagal menambahkan mata kuliah', 500);
        }
    }

    public function show($id)
    {
        try {
            $mataKuliah = Matakuliah::findOrFail($id);
            return ResponseFormatter::success($mataKuliah, 'Data mata kuliah berhasil diambil');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Mata kuliah tidak ditemukan', 404);
        }
    }

    public function edit($id) 
    {
        try {
            $mataKuliah = Matakuliah::findOrFail($id);
            return response()->json([
                'status' => true,
                'data' => $mataKuliah
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false, 
                'message' => 'Mata kuliah tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_matakuliah' => 'required|string|max:20|unique:m_matakuliah,kode_matakuliah,' . $id,
            'nama_matakuliah' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer|min:1|max:14',
            'deskripsi' => 'nullable|string',
            'status' => 'boolean'
        ], [
            'kode_matakuliah.required' => 'Kode mata kuliah harus diisi',
            'kode_matakuliah.unique' => 'Kode mata kuliah sudah digunakan',
            'nama_matakuliah.required' => 'Nama mata kuliah harus diisi',
            'sks.required' => 'SKS harus diisi',
            'sks.integer' => 'SKS harus berupa angka',
            'sks.min' => 'SKS minimal 1',
            'sks.max' => 'SKS maksimal 6',
            'semester.required' => 'Semester harus diisi',
            'semester.integer' => 'Semester harus berupa angka',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 14'
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error($validator->errors(), 'Validasi gagal', 422);
        }

        try {
            DB::beginTransaction();
            
            $mataKuliah = Matakuliah::findOrFail($id);
            $data = $request->all();
            $data['status'] = $request->has('status') ? true : false;
            
            $mataKuliah->update($data);
            
            DB::commit();
            return ResponseFormatter::success(null, 'Mata kuliah berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return ResponseFormatter::error($e->getMessage(), 'Gagal memperbarui mata kuliah', 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            $mataKuliah = Matakuliah::findOrFail($id);
            
            // Check if mata kuliah has related projects
            if ($mataKuliah->projects()->exists()) {
                return ResponseFormatter::error(null, 'Mata kuliah tidak dapat dihapus karena masih memiliki proyek terkait', 422);
            }
            
            $mataKuliah->delete();
            
            DB::commit();
            return ResponseFormatter::success(null, 'Mata kuliah berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return ResponseFormatter::error($e->getMessage(), 'Gagal menghapus mata kuliah', 500);
        }
    }
} 