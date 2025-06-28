<?php

namespace App\Services;

use App\Repositories\ExportDataRepository;

use App\Exports\LogTransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

use RealRashid\SweetAlert\Facades\Alert;

class ExportDataService
{
    protected $repo;

    public function __construct(ExportDataRepository $repo)
    {
        $this->repo = $repo;
    }

    public function exportLogTransaksi($ext, $filename, $FromDate, $EndDate, $menu)
    {
        $map = [
            'csv'  => ExcelFormat::CSV,
        ];

        $writerType = $map[$ext] ?? ExcelFormat::XLSX;

        $result = $this->repo->getDataForExport($FromDate, $EndDate, $menu);

        if ($result['data']->isEmpty()) {
            Alert::error('Gagal Export', 'Data Kosong di range tanggal tersebut');
            return redirect()->back();
        }

        return Excel::download(
            new LogTransaksiExport($result['data'], $result['columns']),
            $filename,
            $writerType
        );
    }

}