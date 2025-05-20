<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProject extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string',
            'mahasiswa_id' => 'required|array',
            'mahasiswa_id.*' => 'exists:m_mahasiswa,id',
            'tahun_akademik' => 'required|exists:m_tahun_akademik,id',
            'matakuliah' => 'required|exists:m_matakuliah,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama harus memiliki maksimal 255 karakter',
            'kategori.required' => 'Kategori harus diisi',
            'kategori.exists' => 'Kategori tidak valid',
            'deskripsi.string' => 'Deskripsi harus berupa string',
            'link.string' => 'Link harus berupa string',
            'mahasiswa_id.required' => 'Mahasiswa harus diisi',
            'mahasiswa_id.array' => 'Mahasiswa harus berupa array',
            'mahasiswa_id.*.exists' => 'Mahasiswa tidak valid',
            'tahun_akademik.required' => 'Tahun Akademik harus diisi',
            'tahun_akademik.exists' => 'Tahun Akademik tidak valid',
            'matakuliah.required' => 'Matakuliah harus diisi',
            'matakuliah.exists' => 'Matakuliah tidak valid',
        ];
    }
}