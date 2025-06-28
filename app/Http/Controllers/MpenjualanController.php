<?php

/* 
    untuk controller ini menggunakan service-repository with repositry interface

    jadi dari controller -> service -> repository -> model

    jadi nanti di repository dibagi 2 yaitu contracts dan eloquent

    contract sebagai interfacenya sedangkan eloquent berisikan yang konek ke modelnya

    jadi nanti di servicenya itu manggil interfacenya karena di dalam repository aslinya berisikan

    "implements" dari interfacenya , jadi luarnya itu interfacenya dalemnya yang asli repositorynya

    sama nanti antara interface sama repositoriesnya di daftarinnya di config/app.php bagian providers 

    nah yang didaftarin itu adalah providersnya , jadi bikin custom providers sendiri bikinnya seperti ini 

    php artisan make:provider MpenjualanServiceProvider 

    nanti tinggal di daftarin di app.php nya -> App\Providers\MpenjualanServiceProvider::class,

    dan juga menggunakan custom validation request 

    yaitu storerequest (untuk create) dan updaterequest (untuk update)
*/

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\MasterPenjualan\StoreRequest;
use App\Http\Requests\MasterPenjualan\UpdateRequest;

use App\Services\MpenjualanService;

use App\Models\Bpenjualan;

use App\Traits\AksesMenuTrait;

class MpenjualanController extends Controller
{
    protected $service;

    use AksesMenuTrait;

    public function __construct(MpenjualanService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $active = "master_penjualan";
        $tpenjualan = $this->service->getAll(request('search'));
        $aksesMenu   = $this->settingAksesMenu('master_penjualan');
        return view('Masterpenjualan.index', compact('tpenjualan', 'aksesMenu', 'active'));
    }

    public function create()
    {
        $active           = "master_penjualan";
        $barang_penjualan = Bpenjualan::all();
        return view('Masterpenjualan.create', compact('barang_penjualan', 'active'));
    }

    public function store(StoreRequest $request)
    {
        $this->service->create($request->validated());

        Alert::success('Berhasil', 'Tambah Master Data Penjualan');
        return redirect('/master-penjualan');
    }

    public function edit($id)
    {
        $active         = "master_penjualan";
        $data           = $this->service->find($id, "buat_edit");
        $data['active'] = $active;

        return view('Masterpenjualan.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        Alert::success('Berhasil', 'Edit Master Data Penjualan');
        return redirect('/master-penjualan');
    }
    
    public function destroy($id)
    {
        $this->service->delete($id);
        Alert::success('Berhasil', 'Hapus Master Data Penjualan');
        return redirect('/master-penjualan');
    }
}