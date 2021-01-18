{{-- edit payment --}}
{{-- <a title="Edit Payment"
    href="{{ route('expense.payments.edit', ['id' => $row->id, 'expense_id' => $row->expense->id]) }}"
    class="btn btn-sm btn-primary">
    <i class="fa fa-edit"></i>
</a> --}}

{{-- delete payment --}}
<a title="Delete Payment" data-toggle="tooltip" data-placement="top" title="Delete"
    href="{{ route('expense.payments.delete', ['id' => $row->id, 'expense_id' => $row->expense->id]) }}"
    class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this Record?')"><i
        class="fa fa-trash-o" aria-hidden="true"></i>
</a>
