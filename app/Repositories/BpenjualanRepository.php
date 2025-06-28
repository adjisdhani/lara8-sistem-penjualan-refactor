<?php

namespace App\Repositories;

use App\Supports\ModelContainer;
use App\Traits\SettingPaginateTrait;

class BpenjualanRepository
{
    protected $models;

    use SettingPaginateTrait;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function getAll($search = null)
    {
        return $this->models->bpenjualan::orderBy('nama_barang', 'asc')
            ->filter(['search' => $search])
            ->paginate($this->settingPaginate())
            ->withQueryString();
    }

    public function create(array $data)
    {
        return $this->models->bpenjualan::create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->models->bpenjualan::findOrFail($id);
        return $item->update($data);
    }

    public function delete($id)
    {
        $this->models->tpenjualan::where('nama_barang_id', $id)->delete();
        return $this->models->bpenjualan::findOrFail($id)->delete();
    }

    public function find($id)
    {
        return $this->models->bpenjualan::findOrFail($id);
    }
}