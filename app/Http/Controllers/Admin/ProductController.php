<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models;
use DB;


class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        $products = Models\Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Models\Category::whereNull('parent_id')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'nullable|array',
        ]);

        $category = Category::find($request->category_id);

        foreach ($category->attributes()->wherePivot('required', true)->get() as $attr) {
            $request->validate([
                'attributes.' . $attr->id => 'required'
            ]);
        }

        DB::transaction(function () use ($request) {
            $product = Models\Product::create($request->only('name', 'category_id'));

            if ($request->has('attributes')) {
                foreach ($request->attributes as $attribute_id => $value) {
                    $product->attributeValues()->attach($value, ['attribute_id' => $attribute_id]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Models\Product $product)
    {
        $categories = Models\Category::whereNull('parent_id')->get();
        $selectedAttributeValues = $product->attributeValues()->pluck('value', 'attribute_id')->toArray();
        return view('admin.products.edit', compact('product', 'categories', 'selectedAttributeValues'));
    }

    public function update(Request $request, Models\Product $product)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'attributes' => 'nullable|array',
        ]);

        DB::transaction(function () use ($request, $product) {
            $product->update($request->only('name', 'category_id'));
            $product->attributeValues()->detach();

            if ($request->has('attributes')) {
                foreach ($request->attributes as $attribute_id => $value) {
                    $product->attributeValues()->attach($value, ['attribute_id' => $attribute_id]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Models\Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
