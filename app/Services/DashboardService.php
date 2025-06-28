<?php

namespace App\Services;

use App\Supports\ModelContainer;
use App\Traits\SettingPaginateTrait;

class DashboardService
{
    protected $models;

    use SettingPaginateTrait;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function index()
    {
        return [
            'wtransaksi'      => $this->models->wtransaksi::offset(1)->limit($this->settingPaginate())->latest()->get(),
            'maxstok'         => $this->models->tpenjualan::max('stok'),
            'minstok'         => $this->models->tpenjualan::min('stok'),
            'maxterjual'      => $this->models->tpenjualan::max('jumlah_terjual'),
            'minterjual'      => $this->models->tpenjualan::min('jumlah_terjual'),
            'jpenjualancount' => $this->models->jpenjualan::count(),
            'bpenjualancount' => $this->models->bpenjualan::count(),
            'mpenjualancount' => $this->models->tpenjualan::count(),
            'wtransaksicount' => $this->models->wtransaksi::count(),
            'active'          => 'dashboard'
        ];
    }
}
