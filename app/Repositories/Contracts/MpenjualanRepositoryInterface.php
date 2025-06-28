<?php

namespace App\Repositories\Contracts;

interface MpenjualanRepositoryInterface
{
    public function getAll($search = null);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function find(int $id, ?string $flag);
}
