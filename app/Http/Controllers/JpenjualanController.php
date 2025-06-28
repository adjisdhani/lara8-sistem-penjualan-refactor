<?php

/* 
    untuk controller ini menggunakan service-repository with repositry interface

    jadi dari controller -> service -> repository -> model

    jadi nanti di repository dibagi 2 yaitu contracts dan eloquent

    contract sebagai interfacenya sedangkan eloquent berisikan yang konek ke modelnya

    jadi nanti di servicenya itu manggil interfacenya karena di dalam repository aslinya berisikan

    "implements" dari interfacenya , jadi luarnya itu interfacenya dalemnya yang asli repositorynya

    sama nanti antara interface sama repositoriesnya di daftarinnya di AppServiceProvider.php (App\Providers\AppServiceProvider.php)

    dan juga menggunakan custom validation request 

    yaitu storerequest (untuk create) dan updaterequest (untuk update)
*/

namespace App\Http\Controllers;
use RealRashid\SweetAlert\Facades\Alert;

use App\Services\JpenjualanService;

use App\Http\Requests\JenisPenjualan\StoreRequest;
use App\Http\Requests\JenisPenjualan\UpdateRequest;

use App\Traits\AksesMenuTrait;
// use App\Traits\GatePermissionTrait;

class JpenjualanController extends Controller
{
    protected $service;

    // use AksesMenuTrait, GatePermissionTrait;
    use AksesMenuTrait;

    public function __construct(JpenjualanService $service)
    {
        $this->service = $service;

        // $this->applyGatePermissions("jenis_penjualan");
    }

    public function index()
    {
        $active      = "jenis_penjualan";
        $jpenjualan  = $this->service->getAll(request('search'));
        $aksesMenu   = $this->settingAksesMenu('jenis_penjualan');
        return view('Jenispenjualan.index', compact('jpenjualan', 'aksesMenu', 'active'));
    }

    public function create()
    {
        $active = "jenis_penjualan";
        return view('Jenispenjualan.create', compact('active'));
    }

    public function store(StoreRequest $request)
    {
        $this->service->create($request->only(['jenis_penjualan']));

        Alert::success('Berhasil', 'Tambah Data Jenis Penjualan');
        return redirect('/jenis-penjualan');
    }

    public function edit($id)
    {
        $active = "jenis_penjualan";
        $jpenjualan = $this->service->find($id);
        return view('Jenispenjualan.edit', compact('jpenjualan', 'active'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->only(['jenis_penjualan']));
        Alert::success('Berhasil', 'Edit Data Jenis Penjualan');
        return redirect('/jenis-penjualan');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        Alert::success('Berhasil', 'Hapus Data Jenis Penjualan');
        return redirect('/jenis-penjualan');
    }
}