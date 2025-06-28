<?php

namespace App\Repositories;

use App\Traits\SettingPaginateTrait;
use App\Models\User;

class SettingUserRepository
{
    use SettingPaginateTrait;

    public function getAll($search = null)
    {
        return User::orderBy('name', 'asc')
            ->where(function ($query) {
                $query->where('Status', 'active')
                      ->where('role', '!=', 'superadmin');
            })
            ->filter(['search' => $search])
            ->paginate($this->settingPaginate())
            ->withQueryString();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $item = User::findOrFail($id);
        return $item->update($data);
    }

    public function delete($id)
    {
        // User::where('id', $id)->delete();
        // return User::findOrFail($id)->delete();

        $item = User::findOrFail($id);
        return $item->update([
            'Status' => 'inactive'
        ]);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }
}