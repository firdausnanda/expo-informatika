<?php

namespace App\Http\Requests\Admin\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectGambar extends FormRequest
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
            'gambar' => 'required|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'gambar.required' => 'Gambar harus diisi.',
            'gambar.*.image' => 'File harus gambar.',
            'gambar.*.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'gambar.*.max' => 'Gambar maksimal 2MB.',
        ];
    }
}
