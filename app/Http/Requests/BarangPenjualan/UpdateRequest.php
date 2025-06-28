<?php

namespace App\Http\Requests\BarangPenjualan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|unique:barang_penjualan,nama_barang,' . $this->route('barang_penjualan'),
            'jenis_penjualan_id' => 'required|exists:jenis_penjualan,id',
        ];
    }

    public function messages()
    {
        return [
            'nama_barang.required' => 'Nama barang tidak boleh kosong.',
            'nama_barang.unique' => 'Nama barang sudah terdaftar.',
            'jenis_penjualan_id.required' => 'Jenis penjualan wajib dipilih.',
            'jenis_penjualan_id.exists' => 'Jenis penjualan tidak valid.',
        ];
    }
}
