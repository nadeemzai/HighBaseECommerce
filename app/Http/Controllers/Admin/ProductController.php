<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        $products = $this->productService->listPaginated();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->productService->getAllCategories(); // use service/repo to fetch
        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $this->productService->create($request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Product created');
    }

    public function edit($id)
    {
        $product = $this->productService->show($id);
        $categories = $this->productService->getAllCategories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated());
        return redirect()->route('admin.products.index')->with('success', 'Product updated');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted');
    }
}
