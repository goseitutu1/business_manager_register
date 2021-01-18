@extends('UI_new.master')
@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush
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
                            <p><span class="text-bold-600"><i class="ft-info"></i></span> {{$page->section}}</p>

                            <div class="row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cost_price">Batch No</label>
                                        <input type="text" class="form-control" placeholder="Auto Generated" id="batch_no"
                                               value="{{ $data->batch_no }}" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cost_price">Description</label>
                                        <input type="text" class="form-control" placeholder="Auto Generated" id="description"
                                               value="{{ $data->description }}" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row"></div>
                                <div class="row" style="padding: 0 20px 0 20px">
                                    <div id="jsGrid"></div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4"></div>
                                    <div class="form-group col-md-4">
                                        <label for="debit_total">TOTAL DEBIT</label>
                                        <input type="text" name="debit_total" id="dr_total"
                                               value="{{ number_format($data->debit_total, 2) }}" class="form-control text-right" readonly
                                               placeholder="0" id="debit_total">
                                    </div>
                                    <div class="form-grup col-md-4">
                                        <label for="credit_total">TOTAL CREDIT</label>
                                        <input type="text" name="credit_total" id="cr_total"
                                               value="{{ number_format($data->credit_total, 2) }}" class="form-control text-right" readonly
                                               placeholder="0" id="credit_total">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
<script type="text/javascript">
    let data = {!! $entries !!},
        accounts = {!! $accounts !!};

    $(document).ready(function () {
        $("#jsGrid").jsGrid({
            width: "100%",
            height: "400px",
            inserting: false,
            editing: false,
            sorting: true,
            paging: true,
            noDataContent: "Please Add Journal Entries",
            data: data,
            rowClick: function (args) {
                selectedItem = args.item;
                $selectedRow = $(args.event.target).closest("tr");
                $selectedRow.addClass("selected-row");
            },
            fields: [
                {
                    name: "debit_account_id",
                    title: "ACCOUNT TO DEBIT",
                    type: "select2", items: accounts, valueField: "id", textField: "name",
                    align: "left", width: 150
                },
                {
                    name: "credit_account_id",
                    title: "ACCOUNT TO CREDIT",
                    type: "select2", items: accounts, valueField: "id", textField: "name",
                    width: 150, align: "left"
                },
                {
                    name: "amount",
                    title: "AMOUNT",
                    type: "decimal", width: 100, align: "right", validate: "required",
                    itemTemplate: function (value) {
                        return value.toFixed(2);
                    }
                },
                {
                    name: "comment",
                    title: "COMMENT",
                    type: "text", width: 200, align: "left", validate: "required", readonly: true
                },
            ]
        });

    });
</script>
@endpush
