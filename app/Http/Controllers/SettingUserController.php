<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SettingUserService;
use RealRashid\SweetAlert\Facades\Alert;

use App\Http\Requests\SettingUser\StoreRequest;
use App\Http\Requests\SettingUser\UpdateRequest;

class SettingUserController extends Controller
{
    protected $service;

    public function __construct(SettingUserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $active      = "setting_user";
        $settingUser = $this->service->getAll(request('search'));
        return view('Settinguser.index', compact('settingUser', 'active'));
    }

    public function create()
    {
        $active      = "setting_user";
        $getDataRole = $this->service->getDataRoles();
        return view('Settinguser.create', compact('getDataRole', 'active'));
    }

    public function store(StoreRequest $request)
    {
        $this->service->create($request->only(['name', 'email', 'role']));
        Alert::success('Berhasil', 'Tambah Data User');
        return redirect('/setting-user');
    }

    public function edit($id)
    {
        $active      = "setting_user";
        $getDataRole = $this->service->getDataRoles();
        $settingUser = $this->service->find($id);
        return view('Settinguser.edit', compact('settingUser', 'getDataRole', 'active'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->only(['name', 'email', 'role']));
        Alert::success('Berhasil', 'Edit Data User');
        return redirect('/setting-user');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        Alert::success('Berhasil', 'Menghapus Data User');
        return redirect('/setting-user');
    }

    public function access($id)
    {
        $active      = "setting_user";
        $getDataRole = $this->service->getDataRoles();
        $settingUser = $this->service->find($id);
        return view('Settinguser.edit', compact('settingUser', 'getDataRole', 'active'));
    }
}