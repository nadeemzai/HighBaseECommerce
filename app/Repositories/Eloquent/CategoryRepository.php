<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allWithChildren()
    {
        return Category::with('children')->whereNull('parent_id')->paginate(10);
    }

    public function getAttributes($categoryId)
    {
        return Category::with(['attributes.values'])->findOrFail($categoryId);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function find($id)
    {
        return Category::with('children')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }
}
