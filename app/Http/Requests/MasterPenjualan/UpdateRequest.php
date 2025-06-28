<?php

namespace App\Http\Requests\MasterPenjualan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'stok'           => 'required|integer|min:1',
            'jumlah_terjual' => 'required|integer|min:0',
            'nama_barang_id' => [
                'required',
                'integer',
                Rule::unique('transaksi_penjualan', 'nama_barang_id')
                    ->ignore($this->route('master_penjualan')),
            ]
        ];
    }

    public function messages() : array
    {
        return [
            'stok.required'           => 'Stok wajib diisi',
            'jumlah_terjual.required' => 'Jumlah terjual wajib diisi',
            'nama_barang_id.required' => 'Nama barang wajib diisi'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'stok'           => is_numeric($this->stok) ? $this->stok : null,
            'jumlah_terjual' => is_numeric($this->jumlah_terjual) ? $this->jumlah_terjual : null,
            'nama_barang_id' => is_numeric($this->nama_barang_id) ? $this->nama_barang_id : null,
        ]);
    }
}
