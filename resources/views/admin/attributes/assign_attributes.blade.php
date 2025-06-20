<h2>Assign Attributes to: {{ $category->name }}</h2>
<form method="POST" action="{{ route('admin.categories.attributes.update', $category) }}">
    @csrf
    @foreach($attributes as $attribute)
        <label>
            <input type="checkbox" name="attributes[{{ $attribute->id }}][enabled]" {{ isset($existing[$attribute->id]) ? 'checked' : '' }}>
            {{ $attribute->name }}
        </label>
        <label>
            <input type="checkbox" name="attributes[{{ $attribute->id }}][required]" {{ !empty($existing[$attribute->id]) ? 'checked' : '' }}>
            Required
        </label>
        <br>
    @endforeach
    <button type="submit">Save</button>
</form>
