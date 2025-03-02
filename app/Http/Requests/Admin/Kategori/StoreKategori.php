<?php

namespace App\Http\Requests\Admin\Kategori;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategori extends FormRequest
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
            'nama' => 'required|string|max:255|unique:m_kategori,nama',
            'deskripsi' => 'string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kategori harus diisi',
            'nama.string' => 'Nama kategori harus berupa string',
            'nama.max' => 'Nama kategori harus memiliki maksimal 255 karakter',
            'nama.unique' => 'Nama kategori sudah ada',
            'deskripsi.string' => 'Deskripsi kategori harus berupa string',
            'deskripsi.max' => 'Deskripsi kategori harus memiliki maksimal 255 karakter',
        ];
    }
}