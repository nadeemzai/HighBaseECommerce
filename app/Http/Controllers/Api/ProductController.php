<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['category_id', 'sub_category_id']);
        $products = $this->productService->listFiltered($filters);
        return ProductResource::collection($products)->response();
    }

    public function show($id)
    {
        $product = $this->productService->show($id);
        return new ProductResource($product);
    }
}
