@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Edit Product: <span class="text-indigo-600">{{ $product->name }}</span>
    </h2>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Category</label>
            <select name="category_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Attributes (Optional) -->
        @if($attributes->isNotEmpty())
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Attributes</label>
            <div class="space-y-2">
                @foreach($attributes as $attribute)
                    <div>
                        <label class="text-gray-600">{{ $attribute->name }}</label>
                        <input type="text" name="attributes[{{ $attribute->id }}]" 
                            value="{{ old("attributes.{$attribute->id}", $product->attributeValues->firstWhere('attribute_id', $attribute->id)?->value) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded shadow">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
