<?php

namespace App\Http\Controllers;

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

    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return response()->json(new CategoryResource($category), 201);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categoryService->show($id);
        return response()->json(new CategoryResource($category));
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $category = $this->categoryService->update($id, $request->validated());
        return response()->json(new CategoryResource($category));
    }

    public function destroy($id): JsonResponse
    {
        $this->categoryService->delete($id);
        return response()->json(['message' => 'Category deleted']);
    }
}

