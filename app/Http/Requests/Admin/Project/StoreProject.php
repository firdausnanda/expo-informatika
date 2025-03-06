<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProject extends FormRequest
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
            'kategori' => 'required|exists:m_kategori,id',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa string.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'kategori.required' => 'Kategori harus diisi.',
            'kategori.exists' => 'Kategori tidak valid.',
            'deskripsi.string' => 'Deskripsi harus berupa string.',
            'link.string' => 'Link harus berupa string.',
        ];
    }
}

