<?php

namespace App\Http\Requests\JenisPenjualan;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'jenis_penjualan' => 'required|unique:jenis_penjualan'
        ];
    }

    public function messages() : array
    {
        return [
            'jenis_penjualan.required' => 'Jenis penjualan wajib diisi'
        ];
    }
}
