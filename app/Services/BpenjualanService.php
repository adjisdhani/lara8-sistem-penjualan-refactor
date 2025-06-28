<?php

namespace App\Services;

use App\Repositories\BpenjualanRepository;

class BpenjualanService
{
    protected $repo;

    public function __construct(BpenjualanRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll($search = null)
    {
        return $this->repo->getAll($search);
    }

    public function create(array $data)
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
}