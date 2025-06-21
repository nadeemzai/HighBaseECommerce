@extends('layouts.admin')
@section('title', 'Attributes')

@section('content')
<h1 class="text-2xl mb-4">Attributes</h1>

@if(session('success'))
    <div class="bg-green-100 p-3 mb-4 rounded text-green-700">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.attributes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add Attribute</a>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($attributes as $attribute)
            <tr>
                <td class="border px-4 py-2">{{ $attribute->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.attributes.edit', $attribute) }}" class="text-indigo-600 mr-2">Edit</a>
                    <form action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="border px-4 py-2 text-center">No attributes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $attributes->links() }}
</div>
@endsection
