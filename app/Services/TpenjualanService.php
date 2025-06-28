<?php

namespace App\Services;

use App\Repositories\TpenjualanRepository;

class TpenjualanService
{
    protected $repo;

    public function __construct(TpenjualanRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll($search = null)
    {
        return $this->repo->getAll($search);
    }

    public function reset()
    {
        return $this->repo->reset();
    }
}