<?php

namespace App\Services;

use App\Repositories\SettingMenuRepository;

class SettingMenuService
{
    protected $repo;

    public function __construct(SettingMenuRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll($search = null)
    {
        $getData = $this->repo->getAll($search);

        return $getData;
    }

    public function create(array $data)
    {
        $data["roles"] = implode(",", $data["roles"]);
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $data["roles"] = implode(",", $data["roles"]);
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function menusAddActions($id) 
    {
        return $this->repo->menusAddActions($id);
    }
}