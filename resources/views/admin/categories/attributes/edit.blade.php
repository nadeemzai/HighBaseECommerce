@extends('layouts.admin')
@section('title', 'Assign Attributes')

@section('content')
<h1 class="text-2xl font-bold mb-4">Assign Attributes to Category: {{ $category->name }}</h1>

<form method="POST" action="{{ route('admin.categories.attributes.update', $category) }}">
    @csrf

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr>
                <th class="border px-4 py-2">Attribute</th>
                <th class="border px-4 py-2">Assign</th>
                <th class="border px-4 py-2">Required</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td class="border px-4 py-2">{{ $attribute->name }}</td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="attributes[{{ $attribute->id }}]"
                            {{ array_key_exists($attribute->id, $assigned) ? 'checked' : '' }}>
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="required[]"
                            value="{{ $attribute->id }}"
                            {{ (!empty($assigned[$attribute->id]) && $assigned[$attribute->id]) ? 'checked' : '' }}>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
        <a href="{{ route('admin.categories.index') }}" class="ml-4 text-blue-500 hover:underline">Cancel</a>
    </div>
</form>
@endsection
