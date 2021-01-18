{{-- view item --}}
<a href="{{ route('account.journal.view', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="View">
<i class="fa fa-eye"></i> View
</a>

{{-- edit item --}}
<a title="Edit Journal Entry" href="{{ route('account.journal.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit">
<i class="fa fa-edit"></i> Edit
</a>


{{-- delete item --}}
<a href="{{ route('account.journal.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger" title="View Entries" data-toggle="tooltip" data-placement="top" title="Delete"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
    Delete
</a>
