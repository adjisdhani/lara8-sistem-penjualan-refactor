<?php

namespace App\Http\Controllers;

use App\Services\SettingMenuService;
use App\Services\SettingUserService;
use App\Services\SettingMenuActionService;
use App\Http\Requests\SettingMenu\StoreRequest;
use App\Http\Requests\SettingMenu\UpdateRequest;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\AksesMenuTrait;

class SettingMenuController extends Controller
{
    protected $service;
    protected $serviceUser;
    protected $serviceMenuAction;

    use AksesMenuTrait;

    public function __construct(SettingMenuService $service, SettingUserService $serviceUser, SettingMenuActionService $serviceMenuAction)
    {
        $this->service            = $service;
        $this->serviceUser        = $serviceUser;
        $this->serviceMenuAction  = $serviceMenuAction;
    }

    public function index()
    {
        $active      = "setting_menu";
        $settingMenu = $this->service->getAll(request('search'));
        $aksesMenu   = $this->settingAksesMenu('setting_menu');
        return view('Settingmenu.index', compact('settingMenu', 'aksesMenu', 'active'));
    }

    public function create()
    {
        $active      = "setting_menu";
        $getDataRole = $this->serviceUser->getDataRoles();
        return view('Settingmenu.create', compact('getDataRole', 'active'));
    }

    public function store(StoreRequest $request)
    {
        $this->service->create($request->validated());
        Alert::success('Berhasil', 'Tambah Data Menu');
        return redirect('/setting-menu');
    }

    public function edit($id)
    {
        $active      = "setting_menu";
        $getDataRole = $this->serviceUser->getDataRoles();
        $settingMenu = $this->service->find($id);
        $settingMenu->roles = explode(",", $settingMenu->roles);

        return view('Settingmenu.edit', compact('settingMenu', 'getDataRole', 'active'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->service->update($id, $request->validated());
        Alert::success('Berhasil', 'Edit Data Menu');
        return redirect('/setting-menu');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        Alert::success('Berhasil', 'Menghapus Data Menu');
        return redirect('/setting-menu');
    }

    public function add_action($id)
    {
        $active                   = "setting_menu";
        $getDataAction            = $this->serviceMenuAction->getAll();
        $getDataExistingSetAction = $this->service->menusAddActions($id);
        $settingMenu              = $this->service->find($id);

        return view('Settingmenu.add_action', compact('settingMenu', 'getDataExistingSetAction', 'getDataAction', 'active'));
    }

    public function add_action_proses(Request $request, $id)
    {
        $request['id'] = $id;
        $this->serviceMenuAction->add_action($request);
        Alert::success('Berhasil', 'Tambah Data Action Menu');
        return redirect('/setting-menu');
    }
}
