<div class="d-inline-flex p2">
    {{-- view customer --}}
    <a title="View Customer Details" href="{{ route('customer.view', ['id' => $row->id]) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View"><i
        class="fa fa-eye" aria-hidden="true"></i>
    </a>

    {{-- edit item --}}
    <a href="{{ route('customer.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" style="margin: 0px 5px 0 5px;">
        <i class="fa fa-edit"></i>
    </a>

    {{-- delete item --}}
    <a href="{{ route('customer.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
        onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
    </a>
</div>
