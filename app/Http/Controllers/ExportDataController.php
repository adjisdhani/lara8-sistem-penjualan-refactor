<?php

namespace App\Http\Controllers;

use App\Services\ExportDataService;
use App\Services\SettingMenuService;
use Illuminate\Http\Request;

class ExportDataController extends Controller
{
    protected $service;
    protected $serviceMenu;

    public function __construct(ExportDataService $service, SettingMenuService $serviceMenu)
    {
        $this->service     = $service;
        $this->serviceMenu = $serviceMenu;
    }

    public function index()
    {
        $active       = "export_data";
        $getDataMenus = $this->serviceMenu->getAll();
        return view('Exportdata.index', compact('getDataMenus', 'active'));
    }

    public function execute(Request $request)
    {
        $ext      = $request->input('format', 'xlsx');
        $FromDate = $request->input('FromDate');
        $EndDate  = $request->input('EndDate');
        $menu     = $request->input('menu');

        $filename = 'Log-Data-'.str_replace(' ', '-', ucwords(str_replace('_', ' ', $menu))).'-'.now()->format('YmdHis').'.'.$ext;

        return $this->service->exportLogTransaksi($ext, $filename, $FromDate, $EndDate, $menu);
    }

}
