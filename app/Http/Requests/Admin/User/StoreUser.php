<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUser extends FormRequest
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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => ['required', 'string', Rule::in(RoleEnum::cases())],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama harus memiliki maksimal 255 karakter',
            'username.required' => 'Username harus diisi',
            'username.string' => 'Username harus berupa string',
            'username.max' => 'Username harus memiliki maksimal 255 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa email yang valid',
            'email.max' => 'Email harus memiliki maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password harus memiliki minimal 8 karakter',
            'role.required' => 'Role harus diisi',
            'role.string' => 'Role harus berupa string',
            'role.in' => 'Role harus berupa ' . implode(', ', array_map(fn($role) => $role->value, RoleEnum::cases())),
        ];
    }
}