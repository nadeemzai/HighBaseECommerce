<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models;

class CategoryAttributeController extends Controller
{
    public function edit(Models\Category $category)
    {
        $attributes = Models\Attribute::all();
        $existing = $category->attributes->pluck('pivot.is_required', 'id')->toArray();
        return view('admin.categories.assign_attributes', compact('category', 'attributes', 'existing'));
    }

    public function update(Request $request, Models\Category $category)
    {
        $syncData = [];
        foreach ($request->input('attributes', []) as $attributeId => $data) {
            $syncData[$attributeId] = ['is_required' => isset($data['required'])];
        }
        $category->attributes()->sync($syncData);
        return redirect()->route('admin.categories.index')->with('success', 'Attributes assigned.');
    }
}
