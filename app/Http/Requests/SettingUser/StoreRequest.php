<?php

namespace App\Http\Requests\SettingUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:user,editor'
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'Nama user harus diisi',
            'email.required'  => 'Email harus diisi',
            'email.email'     => 'Format email tidak valid',
            'email.unique'    => 'Email sudah terdaftar',
            'role.required'   => 'Role wajib dipilih.'
        ];
    }
}
