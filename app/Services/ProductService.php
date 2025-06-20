<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepo) {}

    public function all()
    {
        return $this->productRepo->all();
    }

    public function listFiltered(array $filters)
    {
        return $this->productRepo->filter($filters);
    }

    public function find($id)
    {
        return $this->productRepo->find($id);
    }

    public function create($data)
    {
        return $this->productRepo->create($data);
    }

    public function update($id, $data)
    {
        return $this->productRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepo->delete($id);
    }
}
