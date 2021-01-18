<div class="d-inline-flex">
    {{-- edit item --}}
    <a href="{{ route('sales.service.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip"
        data-placement="top" title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    {{-- print receipt --}}
    <a class="btn btn-sm btn-secondary" href="{{ route('sales.service.print') }}?item={{ $row->id_hash }}">
        <i class="fa fa-print"></i>
    </a>

</div>
