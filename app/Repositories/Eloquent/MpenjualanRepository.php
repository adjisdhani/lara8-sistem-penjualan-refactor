<?php

namespace App\Repositories\Eloquent;

use App\Supports\ModelContainer;
use App\Repositories\Contracts\MpenjualanRepositoryInterface;
use App\Traits\SettingPaginateTrait;

class MpenjualanRepository implements MpenjualanRepositoryInterface
{
    protected $models;

    use SettingPaginateTrait;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function getAll($search = null)
    {
        return $this->models->tpenjualan::with('barang_penjualan')
                          ->has('barang_penjualan')
                          ->latest()
                          ->filter(request($search))
                          ->paginate($this->settingPaginate())
                          ->WithQueryString();
    }

    public function create(array $data)
    {
        $this->models->tpenjualan::create([
            "stok"           => $data["stok"],
            "jumlah_terjual" => $data["jumlah_terjual"],
            "nama_barang_id" => $data["nama_barang_id"],
        ]);

        $bpenjualan = $this->models->bpenjualan::find($data["nama_barang_id"]);
        $jpenjualan = $this->models->jpenjualan::find($bpenjualan['jenis_penjualan_id']);

        return $this->models->wtransaksi::create([
            "nama_barang"     => $bpenjualan["nama_barang"],
            "jenis_penjualan" => $jpenjualan['jenis_penjualan'],
            "stok"            => $data["stok"],
            "jumlah_terjual"  => $data["jumlah_terjual"],
        ]);
    }

    public function update($id, array $data)
    {
        $tpenjualan = $this->models->tpenjualan::findOrFail($id);

        $data_barang = [
            "stok"           => $data["stok"],
            "jumlah_terjual" => $data["jumlah_terjual"],
            "nama_barang_id" => $data["nama_barang_id"],
        ];

        $bpenjualan = $this->models->bpenjualan::findOrFail($data["nama_barang_id"]);
        $jpenjualan = $this->models->jpenjualan::findOrFail($bpenjualan['jenis_penjualan_id']);

        $this->models->wtransaksi::create([
            "nama_barang"       => $bpenjualan["nama_barang"],
            "jenis_penjualan"   => $jpenjualan['jenis_penjualan'],
            "stok"              => $data["stok"],
            "jumlah_terjual"    => $data["jumlah_terjual"],
        ]);

        return $tpenjualan->update($data_barang);
    }

    public function delete($id)
    {
        $tpenjualan = $this->models->tpenjualan::findOrFail($id);
        return $tpenjualan->delete();
    }

    public function find(int $id, ?string $flag)
    {
        if (empty($flag)) {
            return $this->models->tpenjualan::findOrFail($id);
        } else {
            $tpenjualan       = $this->models->tpenjualan::findOrFail($id);
            $barang_penjualan = $this->models->bpenjualan::all();

            return [
                'tpenjualan'       => $tpenjualan,
                'barang_penjualan' => $barang_penjualan,
            ];
        }
    }
}