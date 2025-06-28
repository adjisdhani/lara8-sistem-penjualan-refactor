<?php

namespace App\Repositories;

use App\Supports\ModelContainer;
use App\Traits\SettingPaginateTrait;

class TpenjualanRepository
{
    protected $models;

    use SettingPaginateTrait;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function getAll($search = null)
    {
        return $this->models->wtransaksi::latest()
                ->filter(['search' => $search])
                ->paginate($this->settingPaginate())
                ->WithQueryString();
    }

    public function reset()
    {
        return $this->models->wtransaksi::truncate();
    }
}