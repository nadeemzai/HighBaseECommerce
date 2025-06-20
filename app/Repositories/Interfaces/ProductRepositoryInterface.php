<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function filter(array $filters);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
