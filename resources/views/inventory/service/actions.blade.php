{{-- view item --}}
<a href="{{ route('inventory.service.view', ['id' => $row->id]) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
</a>

{{-- edit item --}}
<a href="{{ route('inventory.service.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fa fa-edit"></i>
</a>

{{-- delete item --}}
<a href="{{ route('inventory.service.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
