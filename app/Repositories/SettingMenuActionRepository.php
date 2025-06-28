<?php

namespace App\Repositories;

use App\Traits\SettingPaginateTrait;
use App\Models\MenusAction;
use App\Models\MenusAddAction;

class SettingMenuActionRepository
{
    use SettingPaginateTrait;

    public function getAll($search = null)
    {
        return MenusAction::orderBy('label', 'asc')
            ->where(function ($query) {
                $query->where('Status', 'active');
            })
            ->filter(['search' => $search])
            ->paginate($this->settingPaginate())
            ->withQueryString();
    }

    public function create(array $data)
    {
        return MenusAction::create($data);
    }

    public function update($id, array $data)
    {
        $item = MenusAction::findOrFail($id);

        return $item->update($data);
    }

    public function delete($id)
    {

        $item = MenusAction::findOrFail($id);
        return $item->update([
            'Status' => 'inactive'
        ]);
    }

    public function delete_hard($id)
    {

        return MenusAddAction::where('MenusID', $id)->delete();
    }

    public function find($id)
    {
        return MenusAction::findOrFail($id);
    }

    public function find_hard($id)
    {
        return MenusAddAction::where('MenusID', $id)->get();
    }

    public function add_action($data)
    {
        return MenusAddAction::insert($data);
    }
}