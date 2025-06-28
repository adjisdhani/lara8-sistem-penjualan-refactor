<?php

/* 
    untuk controller ini menggunakan service-repository pattern

    jadi dari controller -> service -> repository -> model

    dan juga menggunakan custom validation request 

    yaitu storerequest (untuk create) dan updaterequest (untuk update)
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Controller;
use App\Services\BpenjualanService;
use App\Models\Jpenjualan;
use RealRashid\SweetAlert\Facades\Alert;

use App\Http\Requests\BarangPenjualan\StoreRequest;
use App\Http\Requests\BarangPenjualan\UpdateRequest;

use App\Traits\AksesMenuTrait;
use App\Traits\GatePermissionTrait;


class BpenjualanController extends Controller
{
    protected $service;

    // use AksesMenuTrait, GatePermissionTrait;
    use AksesMenuTrait;

    public function __construct(BpenjualanService $service)
    {
        $this->service = $service;

        // $this->applyGatePermissions("barang_penjualan");
    }

    public function index()
    {
        $active = "barang_penjualan";
        $bpenjualan = $this->service->getAll(request('search'));
        $aksesMenu   = $this->settingAksesMenu('barang_penjualan');
        return view('Barangpenjualan.index', compact('bpenjualan', 'aksesMenu', 'active'));
    }

    public function create()
    {

        $active = "barang_penjualan";
        $jenis_p = Jpenjualan::all();
        return view('Barangpenjualan.create', compact('jenis_p', 'active'));
    }

    public function store(StoreRequest $request)
{
        $this->service->create($request->only(['nama_barang', 'jenis_penjualan_id']));
        Alert::success('Berhasil', 'Tambah Data Barang Penjualan');
        return redirect('/barang-penjualan');
    }

    public function edit($id)
    {
        $active = "barang_penjualan";
        $bpenjualan = $this->service->find($id);
        $jenis_p = Jpenjualan::all();
        return view('Barangpenjualan.edit', compact('bpenjualan', 'jenis_p', 'active'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->only(['nama_barang', 'jenis_penjualan_id']));
        Alert::success('Berhasil', 'Edit Data Barang Penjualan');
        return redirect('/barang-penjualan');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        Alert::success('Berhasil', 'Menghapus Data Barang Penjualan');
        return redirect('/barang-penjualan');
    }
}