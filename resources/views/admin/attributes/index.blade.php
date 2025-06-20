<h2>Attributes</h2>
<a href="{{ route('admin.attributes.create') }}">Create</a>
<ul>
    @foreach($attributes as $attribute)
        <li>{{ $attribute->name }}
            <a href="{{ route('admin.attributes.edit', $attribute) }}">Edit</a>
            <form action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST">@csrf @method('DELETE')<button>Delete</button></form>
        </li>
    @endforeach
</ul>
