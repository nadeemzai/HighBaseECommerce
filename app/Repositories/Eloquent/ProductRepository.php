<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::with('category')->get();
    }

    public function filter(array $filters)
    {
        return Product::query()
            ->when($filters['category_id'] ?? null, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            /* ->when($filters['sub_category_id'] ?? null, function ($query, $subCategoryId) {
                $query->where('sub_category_id', $subCategoryId);
            }) */
            ->with(['category', 'subCategory', 'attributes']) // eager load
            ->latest()
            ->paginate(10);
    }

    public function find($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }
}
