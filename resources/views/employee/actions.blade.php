<div class="d-inline-flex">
    {{-- edit item --}}
    <a title="Edit Employee Information" href="{{ route('employee.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    {{-- delete item --}}
    <a title="Delete Employee" href="{{ route('employee.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
        onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
    </a>
</div>
