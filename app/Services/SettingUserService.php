<?php

namespace App\Services;

use App\Repositories\SettingUserRepository;

class SettingUserService
{
    protected $repo;

    public function __construct(SettingUserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll($search = null)
    {
        $getData = $this->repo->getAll($search);

        if (!empty($getData)) {
            foreach ($getData as &$value) {
                $value->role = ucfirst($value->role);
            }
        }

        return $getData;
    }

    public function create(array $data)
    {
        if (!isset($data["password"])) {
            $data["password"] = bcrypt('password');
        }

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

    public function getDataRoles() : array
    {
        $datas = [
            [
                "id"    => "user",
                "label" => "User"
            ],
            [
                "id"    => "staff",
                "label" => "Staff"
            ]
        ];

        if (auth()->user()->role == "superadmin") {
            array_unshift($datas, [
                "id"    => "superadmin",
                "label" => "Superadmin"
            ]);
        }

        return $datas;
    }
}