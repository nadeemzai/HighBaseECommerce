<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Product Name" required>
    
    <select name="category_id" id="category_id" required onchange="this.form.submit()">
        <option value="">-- Select Category --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>

    @if(old('category_id'))
        @php
            $selected = $categories->firstWhere('id', old('category_id'));
        @endphp
        @foreach($selected->attributes as $attribute)
            <input type="text" 
                   name="attributes[{{ $attribute->id }}]" 
                   placeholder="{{ $attribute->name }}" 
                   {{ $attribute->pivot->is_required ? 'required' : '' }}>
        @endforeach
    @endif

    <button type="submit">Create Product</button>
</form>
