<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MahasiswaImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        return new Mahasiswa([
            'nama' => $row['nama'],
            'nim' => $row['nim'],
            'prodi' => $row['prodi'],
            'angkatan' => $row['angkatan'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nim' => 'required|max:255|unique:m_mahasiswa',
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|max:255',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama mahasiswa harus diisi',
            'nim.required' => 'NIM mahasiswa harus diisi',
            'nim.unique' => 'NIM mahasiswa sudah ada',
            'prodi.required' => 'Prodi mahasiswa harus diisi',
            'angkatan.required' => 'Angkatan mahasiswa harus diisi',
            'nama.string' => 'Nama mahasiswa harus berupa string',
            'nim.string' => 'NIM mahasiswa harus berupa string',
            'prodi.string' => 'Prodi mahasiswa harus berupa string',
            'angkatan.string' => 'Angkatan mahasiswa harus berupa string',
            'nama.max' => 'Nama mahasiswa maksimal 255 karakter',
            'nim.max' => 'NIM mahasiswa maksimal 255 karakter',
            'prodi.max' => 'Prodi mahasiswa maksimal 255 karakter',
            'angkatan.max' => 'Angkatan mahasiswa maksimal 255 karakter',
        ];
    }
}
