<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function allWithChildren();

    public function getAttributes($categoryId);

    public function create(array $data);

    public function find($id);

    public function update($id, array $data);

    public function delete($id);
}
