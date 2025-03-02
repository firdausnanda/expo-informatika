<?php

namespace App\Http\Requests\Admin\Mahasiswa;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswa extends FormRequest
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
            'nim' => 'required|string|max:255|unique:m_mahasiswa,nim,' . $this->id,
            'prodi' => 'required|string|max:255',
            'angkatan' => 'required|string|max:255',
        ];
    }

    public function messages(): array
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