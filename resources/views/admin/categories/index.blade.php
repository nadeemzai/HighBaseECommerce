<h2>Categories</h2>
<a href="{{ route('admin.categories.create') }}">Create</a>
<table>
    <tr><th>Name</th><th>Parent</th><th>Actions</th></tr>
    @foreach($categories as $cat)
        <tr>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->parent?->name }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $cat) }}">Edit</a>
                <a href="{{ route('admin.categories.attributes.edit', $cat) }}">Assign Attributes</a>
                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST">@csrf @method('DELETE')<button>Delete</button></form>
            </td>
        </tr>
    @endforeach
</table>
