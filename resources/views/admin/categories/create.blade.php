<h2>{{ isset($category) ? 'Edit' : 'Create' }} Category</h2>
<form method="POST" action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
    @csrf
    @if(isset($category)) @method('PUT') @endif

    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Name">
    <select name="parent_id">
        <option value="">No Parent</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ (old('parent_id', $category->parent_id ?? '') == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit">{{ isset($category) ? 'Update' : 'Create' }}</button>
</form>
