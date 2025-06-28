<?php

namespace App\Services;

use App\Repositories\SettingMenuActionRepository;

class SettingMenuActionService
{
    protected $repo;

    public function __construct(SettingMenuActionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll($search = null)
    {
        $getData = $this->repo->getAll($search);

        return $getData;
    }

    public function create($data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
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

    public function add_action($data)
    {
        $newArrayPassing = [];

        $id = $data['id'];
        
        if (!empty($data['action'])) {
            foreach ($data['action'] as $key => $value) {
                $newArrayPassing[] = [
                    "MenusID"       => $data['id'],
                    "MenusActionID" => $value
                ];
            }
        }

        $checkExistingData = $this->repo->find_hard($id);

        if (!empty($checkExistingData)) {
            $this->repo->delete_hard($data['id']);
        }

        return $this->repo->add_action($newArrayPassing);
    }
}