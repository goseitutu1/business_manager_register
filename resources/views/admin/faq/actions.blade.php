{{-- view faq --}}
<div class="btn-group btn-group-xs">
    <a title="Delete" class="btn btn-primary" href="{{ route('admin.customer_support.faq.edit', ['id' => $row->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>
</div>

{{-- view faq --}}
<div class="btn-group btn-group-xs">
    <a title="Delete" class="btn btn-danger" href="{{ route('admin.customer_support.faq.delete', ['id' => $row->id]) }}"
        onclick="return confirm('Do you want to delete this FAQ?')">
        <i class="fa fa-trash-o"></i>
    </a>
</div>
