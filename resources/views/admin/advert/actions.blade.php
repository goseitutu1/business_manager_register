@if(!preg_match('/(approved|published|completed?)/i', @$row->status->name))
    <button class="btn btn-primary" data-advert="{{ $row->id_hash }}" data-toggle="modal" data-target="#price-modal-{{ $row->id }}"><span class="fa fa-plus"></span> Price</button>

    <div class="modal" tabindex="-1" role="dialog" id="price-modal-{{ $row->id }}" aria-labelledby="price-modal-{{ $row->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set Advertisment Price</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.advert.set_price') }}" method="post" id="price-form">
                    <div class="modal-body">
                        @csrf
                        <label class="sr-only" for="price">Set Advert Price</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">GHC</div>
                            </div>
                            <input type="hidden" value="{{ $row->id_hash }}" name="advert">
                            <input type="text" class="form-control" id="price" name="price" required placeholder="eg. 500">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="btn-submit" class="btn btn-primary" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@if(preg_match('/(approved|unpublished|completed?)/i', @$row->status->name))
    <a class="btn btn-secondary" href="{{ route('admin.advert.publish', ['id' => $row->id]) }}">Publish</a>
@endif

@if(preg_match('/^published$/i', @$row->status->name))
    <a class="btn btn-warning" href="{{ route('admin.advert.unpublish', ['id' => $row->id]) }}" onclick="return confirm('Do you want to unpublish this Advert?')">Unpublish</a>
@endif

{{-- view item --}}
<a title="View Advert Information" href="{{ route('admin.advert.view', ['id' => $row->id]) }}"
    class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View">
    <i class="fa fa-eye"></i>
</a>

{{-- delete item --}}
<a title="Delete Advert" href="{{ route('admin.advert.delete', ['id' => $row->id]) }}" class="btn btn-sm btn-danger"
    data-toggle="tooltip" data-placement="top" title="Delete"
    onclick="return confirm('Do you want to delete this Record?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
