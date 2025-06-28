<?php

namespace App\Repositories;

use App\Traits\SettingPaginateTrait;
use App\Models\Menus;

class SettingMenuRepository
{
    use SettingPaginateTrait;

    public function getAll($search = null)
    {
        return Menus::orderBy('label', 'asc')
            ->where(function ($query) {
                $query->where('Status', 'active')
                      ->whereNotIn('key', ['dashboard', 'setting_user', 'setting_menu', 'logout']);
            })
            ->filter(['search' => $search])
            ->paginate($this->settingPaginate())
            ->withQueryString();
    }

    public function create(array $data)
    {
        return Menus::create($data);
    }

    public function update($id, array $data)
    {
        $item = Menus::findOrFail($id);
        return $item->update($data);
    }

    public function delete($id)
    {

        $item = Menus::findOrFail($id);
        return $item->update([
            'Status' => 'inactive'
        ]);
    }

    public function find($id)
    {
        return Menus::findOrFail($id);
    }

    public function menusAddActions($id)
    {
        return Menus::find($id)->menusAddActions()->pluck('MenusActionID')->toArray();
    }
}