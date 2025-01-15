<a href="{{ route('company.edit', $company) }}" class="btn btn-warning btn-sm">Edit</a>
<form action="{{ route('company.destroy', $company) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
</form>
