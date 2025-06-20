<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->list();
        return response()->json(CategoryResource::collection($categories));
    }

    public function attributes($id)
    {
        $category = $this->categoryService->getAttributes($id);
        return response()->json([
            'category_id' => $category->id,
            'attributes' => $category->attributes->map(function ($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->name,
                    'is_required' => $attribute->pivot->is_required,
                    'values' => $attribute->values->pluck('value', 'id')
                ];
            }),
        ]);
    }


}
