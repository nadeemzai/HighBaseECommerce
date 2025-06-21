@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Add Product</h1>

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Product Name</label>
            <input type="text" name="name" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Category</label>
            <select name="category_id" id="categorySelect" class="w-full p-2 border rounded" required>
                <option value="">-- Select --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="attributeFields" class="space-y-4 mt-4"></div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<script>
document.getElementById('categorySelect').addEventListener('change', function () {
    const categoryId = this.value;
    const attributeFields = document.getElementById('attributeFields');
    attributeFields.innerHTML = '';

    if (categoryId) {
        fetch(`/api/categories/${categoryId}/attributes`)
            .then(res => res.json())
            .then(data => {
                data.attributes.forEach(attr => {
                    let field = `<label class="block font-semibold">${attr.name}</label>`;
                    field += `<select name="attributes[${attr.id}]" class="w-full p-2 border rounded" ${attr.is_required ? 'required' : ''}>`;
                    field += `<option value="">-- Select ${attr.name} --</option>`;
                    for (const [id, value] of Object.entries(attr.values)) {
                        field += `<option value="${id}">${value}</option>`;
                    }
                    field += `</select>`;
                    attributeFields.innerHTML += field;
                });
            });
    }
});
</script>
@endsection
