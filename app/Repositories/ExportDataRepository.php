<?php

namespace App\Repositories;
use App\Supports\ModelContainer;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class ExportDataRepository
{
    protected $models;

    public function __construct(ModelContainer $models)
    {
        $this->models = $models;
    }

    public function getDataForExport($FromDate, $EndDate, $menu)
    {
        $partsMenu = explode('_', $menu);
        $resultMenu = substr($partsMenu[0], 0, 1) . $partsMenu[1];

        if ($menu == "transaksi_penjualan") {
            $resultMenu = "wtransaksi";
        }
        
        if ($menu == "master_penjualan") {
            $setParamGlobal = $this->models->tpenjualan::with('barang_penjualan')
                                   ->has('barang_penjualan')
                                   ->getModel();
        } else {
            $setParamGlobal = $this->models->$resultMenu;
        }

        $columns = array_values(array_diff(
            Schema::getColumnListing($setParamGlobal->getTable()),
            ['id']
        ));

        $data = $setParamGlobal->whereBetween('created_at', [
            Carbon::parse($FromDate)->startOfDay(),
            Carbon::parse($EndDate)->endOfDay()
        ])->get();

        return [
            'data'    => $data,
            'columns' => $columns,
        ];
    }

}