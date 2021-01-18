<div class="btn-group btn-group-xs d-inline-flex">
    {{-- Close feedback --}}
    @if(preg_match('/pending/i', $row->status))
    <a title="Edit" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-warning mr-1 ml-1"
        href="{{ route('customer_support.feedback.edit', ['id' => $row->id]) }}"><i class="la la-edit"></i> </a>
    @endif

    {{-- Delete feedback --}}
    <a title="Delete" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger"
        href="{{ route('customer_support.feedback.delete', ['id' => $row->id]) }}"
        onclick="return confirm('Do you want to delete this Record?')"><i class="la la-trash"></i> </a>
</div>
