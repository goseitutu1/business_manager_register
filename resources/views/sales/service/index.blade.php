@extends('UI_new.master')

@section('content')
<div class="content-body" style="margin-top: 5em">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page->title}}</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p><span class="text-bold-600"><i class="la la-info"></i></span> {{$page->section}}</p>

                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="receipt-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header"> --}}
            {{-- <h5 class="modal-title">Set Advertisment Price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <form action="{{ route('admin.advert.set_price') }}" method="post" id="price-form">
                <div class="modal-body text-center mt-3">
                    <a href="#" class="btn btn-info mr-2" id="print-receipt">
                        <i class="fa fa-print"> Print Receipt</i>
                    </a>
                    <a href="#" class="btn btn-primary" id="sms-url"><i class="fa fa-paper-plane"></i> Send as SMS</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')
{{$dataTable->scripts()}}

<script>
    let id = "",
    url = '{!! route('sales.service.print') !!}';
    $( window ).load(function() {
        $(".receipt").click(function(e){
            $('#receipt-modal').modal('show');
            id = $(this).data("item");
        });
    });
    $(document).ready(function(){
        // on save: retrieve form data, append the advert id and submit
        $('#print-receipt').click(function() {
            window.open(`${url}?item=${id}`);
        });
    });
</script>
@endpush
