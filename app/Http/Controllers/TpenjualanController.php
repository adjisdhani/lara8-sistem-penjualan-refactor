<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Services\TpenjualanService;

use App\Traits\AksesMenuTrait;

class TpenjualanController extends Controller
{
    protected $service;

    use AksesMenuTrait;

    public function __construct(TpenjualanService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $active     = "transaksi_penjualan";
        $wtransaksi = $this->service->getAll(request('search'));
        $aksesMenu   = $this->settingAksesMenu('transaksi_penjualan');
        return view('Transaksipenjualan.index', compact('wtransaksi', 'aksesMenu', 'active'));
    }
    
    public function reset()
    {
        $this->service->reset();
        Alert::success('Berhasil', 'Menghapus Seluruh Data Log Transaksi Penjualan');
        return redirect('/transaksi-penjualan');
    }
}