<?php

namespace App\Repositories\Eloquent;

use App\Supports\ModelContainer;
use App\Repositories\Contracts\JpenjualanRepositoryInterface;
use App\Traits\SettingPaginateTrait;

class JpenjualanRepository implements JpenjualanRepositoryInterface
{
    protected $models;

    use SettingPaginateTrait;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function getAll($search = null)
    {
        return $this->models->jpenjualan::orderBy('jenis_penjualan', 'asc')
            ->filter(['search' => $search])
            ->paginate($this->settingPaginate())
            ->withQueryString();
    }

    public function create(array $data)
    {
        return $this->models->jpenjualan::create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->models->jpenjualan::findOrFail($id);
        return $item->update($data);
    }

    public function delete($id)
    {
        // Transaksi Penjualan
        $this->models->tpenjualan::where('jenis_penjualan_id', $id)
            ->join('barang_penjualan', 'barang_penjualan.id', '=', 'transaksi_penjualan.nama_barang_id')
            ->delete();
        // Transaksi Penjualan

        // Barang Penjualan
        $this->models->bpenjualan::where('jenis_penjualan_id', $id)->delete();
        // Barang Penjualan

        $this->models->jpenjualan::where('id', $id)->delete();
        return $this->models->bpenjualan::findOrFail($id)->delete();
    }

    public function find($id)
    {
        return $this->models->jpenjualan::findOrFail($id);
    }
}