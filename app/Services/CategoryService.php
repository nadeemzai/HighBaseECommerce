<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepo) {}

    public function list()
    {
        return $this->categoryRepo->allWithChildren();
    }

    public function getAttributes($categoryId)
    {
        return $this->categoryRepo->getAttributes($categoryId);
    }

    public function create(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    public function show($id)
    {
        return $this->categoryRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepo->delete($id);
    }
}
