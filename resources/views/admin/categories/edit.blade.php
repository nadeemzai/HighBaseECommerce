@extends('layouts.admin')
@section('title', 'Edit Category')

@section('content')
<h1 class="text-2xl mb-4">Edit Category</h1>

<form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4 max-w-md">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-semibold">Category Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border rounded px-3 py-2" required>
        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Parent Category (optional)</label>
        <select name="parent_id" class="w-full border rounded px-3 py-2">
            <option value="">-- None --</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Category</button>
</form>
@endsection
