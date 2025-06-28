<?php

namespace App\Supports;

use App\Models\Bpenjualan;
use App\Models\Tpenjualan;
use App\Models\Jpenjualan;
use App\Models\Wtransakasi;

class ModelContainer
{
    public Jpenjualan  $jpenjualan;
    public Tpenjualan  $tpenjualan;
    public Bpenjualan  $bpenjualan;
    public Wtransakasi $wtransaksi;

    public function __construct()
    {
        $this->jpenjualan = new Jpenjualan();
        $this->tpenjualan = new Tpenjualan();
        $this->bpenjualan = new Bpenjualan();
        $this->wtransaksi = new Wtransakasi();
    }
}
