@extends('layouts.admin')
@section('title', 'Create Attribute')

@section('content')
<h1 class="text-2xl font-bold mb-4">Create Attribute</h1>

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.attributes.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-lg">
    @csrf

    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Attribute Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               required>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Create
        </button>
        <a href="{{ route('admin.attributes.index') }}" class="text-blue-500 hover:underline">Cancel</a>
    </div>
</form>
@endsection
