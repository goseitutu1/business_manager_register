{{-- edit item --}}
<a href="{{ route('expense.category.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-edit"></i> Edit
</a>

{{-- delete item --}}
<a href="{{ route('expense.category.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
    Delete
</a>
