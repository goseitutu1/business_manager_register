{{-- edit item --}}
<a title="Update payment" href="{{ route('sales.payment.owing.update', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Update">
    <i class="fa fa-edit"></i> Update
</a>

{{-- delete item --}}
{{-- <a href="{{ route('sales.product.delete', ['id' => $row->id]) }}" class="btn btn-xs btn-danger"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a> --}}
