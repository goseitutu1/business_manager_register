<div class="d-inline-flex">
    {{-- view item --}}
    <a href="{{ route('inventory.product.view', ['id' => $row->id]) }}" class="btn btn-sm btn-success" style="margin-right: 2px"> <i class="fa fa-eye"></i>
    </a>

    {{-- edit item --}}
    <a href="{{ route('inventory.product.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" style="margin-right: 2px" data-toggle="tooltip" data-placement="top" title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    {{-- delete item --}}
    <a href="{{ route('inventory.product.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
        onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
    </a>
</div>
