@extends('layouts.admin')
@section('title', 'Categories')

@section('content')
<h1 class="text-2xl mb-4">Categories</h1>

@if(session('success'))
    <div class="bg-green-100 p-3 mb-4 rounded text-green-700">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Category</a>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Parent Category</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td class="border px-4 py-2">{{ $category->name }}</td>
                <td class="border px-4 py-2">{{ $category->parent?->name ?? '-' }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 mr-2">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="border px-4 py-2 text-center">No categories found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection
