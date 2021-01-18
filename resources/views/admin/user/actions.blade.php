{{-- view item --}}
<a title="View User Information" href="{{ route('admin.user.view', ['id' => $row->id]) }}"
    class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View">
    <i class="fa fa-eye"></i>
</a>

{{-- edit item --}}
<a title="Edit User Information" href="{{ route('admin.user.edit', ['id' => $row->id]) }}"
    class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-edit"></i>
</a>

{{-- delete item --}}
<a title="Delete User" href="{{ route('admin.user.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger"
    data-toggle="tooltip" data-placement="top" title="Delete"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
