@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow" x-data>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Assign Attributes to: <span class="text-indigo-600">{{ $category->name }}</span>
    </h2>

    <form method="POST" action="{{ route('admin.categories.attributes.update', $category) }}">
        @csrf

        <div class="space-y-4">
            @foreach($attributes as $attribute)
                <div class="border rounded-lg px-4 py-3 flex items-start gap-4 bg-gray-50">
                    <div class="flex items-center gap-2">
                        <input 
                            type="checkbox" 
                            id="attr_{{ $attribute->id }}_enabled"
                            name="attributes[{{ $attribute->id }}][enabled]" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            {{ isset($existing[$attribute->id]) ? 'checked' : '' }}
                        >
                        <label for="attr_{{ $attribute->id }}_enabled" class="text-gray-800 font-medium">
                            {{ $attribute->name }}
                        </label>
                    </div>

                    <div class="flex items-center gap-2 ml-auto">
                        <input 
                            type="checkbox" 
                            id="attr_{{ $attribute->id }}_required"
                            name="attributes[{{ $attribute->id }}][required]" 
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500"
                            {{ !empty($existing[$attribute->id]) ? 'checked' : '' }}
                        >
                        <label for="attr_{{ $attribute->id }}_required" class="text-sm text-gray-600">
                            Required
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 text-right">
            <button 
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded shadow transition-all duration-200"
            >
                Save
            </button>
        </div>
    </form>
</div>
@endsection
