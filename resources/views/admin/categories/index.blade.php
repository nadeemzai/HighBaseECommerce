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
            <th class="border px-4 py-2">Attributes</th> <!-- New -->
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
            <tr>
                <td class="border px-4 py-2">{{ $category->name }}</td>
                <td class="border px-4 py-2">{{ $category->parent?->name ?? '-' }}</td>

                <td class="border px-4 py-2 text-sm">
                    @forelse($category->attributes as $attr)
                        <span class="inline-block bg-gray-100 px-2 py-1 rounded text-gray-700">
                            {{ $attr->name }} 
                            @if($attr->pivot->is_required)
                                <sup class="text-red-500">*</sup>
                            @endif
                        </span>
                    @empty
                        <em class="text-gray-400">—</em>
                    @endforelse
                </td>

                <td class="border px-4 py-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 mr-2">Edit</a>
                    <a href="{{ route('admin.categories.attributes.edit', $category) }}" class="text-blue-600 mr-2">Assign Attributes</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="border px-4 py-2 text-center">No categories found.</td>
            </tr>
        @endforelse
    </tbody>
</table>


<div class="mt-4">
    {{ $categories->links() }}
</div>
@endsection
