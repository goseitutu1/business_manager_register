@extends('UI_new.master')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
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

                            <form method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="cost_price">Batch No</label>
                                            <input type="text" class="form-control" placeholder="Auto Generated" id="batch_no"
                                                   value="{{ $data->batch_no }}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            @php
                                                $_value = !empty(old('description')) ? old('description') : $data->description
                                            @endphp
                                            <label for="cost_price">Description</label>
                                            <input type="text" class="form-control" name="description" placeholder="Auto Generated"
                                                   id="description" value="{{ $_value }}">
                                        </div>
                                        <div class="form-group text-center col-md-4 float-right" style="margin-top: 20px">
                                            <button type="submit" id="save" class="btn btn-primary mb-5"><span
                                                    class="glyphicon glyphicon-floppy-saved"></span> Save Editing</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <input type="hidden" id="entries" name="entries" value="{{ old('entries') }}" />
                                        {{-- <input type="hidden" id="selection" name="selection" value="{{ old('selection') }}" />
                                        <input type="hidden" id="action" name="action" value="{{ old('action') }}" /> --}}
                                    </div>
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
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    let data = {!! !empty(session('js_grid')) ? json_encode(session('js_grid')) : $entries !!},
        accounts = {!! $accounts !!};

    $(document).ready(function () {
        $("#jsGrid").jsGrid({
            width: "100%",
            height: "400px",
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            noDataContent: "Please Add Journal Entries",
            data: data,
            controller: {
                loadData: function (filter) {
                    return data;
                }
            },
            onItemEditing: function (args) {
                if (args.item.is_posted === 1) {
                    args.cancel = true;
                }
            },
            onItemDeleting: function (args) {
                if (args.item.is_posted === 1) {
                    args.cancel = true;
                }
            },
            onItemInserting: function (args) {
                // check for no account selection
                if (args.item.debit_account_id === 0 && args.item.credit_account_id === 0) {
                    alert("Please select a GL Account!");
                    args.cancel = true;
                }
                // check for both account selection
                if (args.item.debit_account_id > 0 && args.item.credit_account_id > 0) {
                    alert("Only one GL Account SHOULD be selected!");
                    args.cancel = true;
                }
                // check for 0 amount
                if (args.item.amount <= 0) {
                    alert("Amount should be greater than zero (0)!")
                    args.cancel = true;
                }
            },
            onItemUpdating: function (args) {
                // check for no account selection
                if (args.item.debit_account_id === 0 && args.item.credit_account_id === 0) {
                    alert("Please select a GL Account!");
                    args.cancel = true;
                }
                // check for both account selection
                if (args.item.debit_account_id > 0 && args.item.credit_account_id > 0) {
                    alert("Only one GL Account SHOULD be selected!");
                    args.cancel = true;
                }
                // check for 0 amount
                if (args.item.amount <= 0) {
                    alert("Amount should be greater than zero (0)!")
                    args.cancel = true;
                }
            },
            onItemInserted: function (args) {
                calculate();
            },
            onItemUpdated: function (args) {
                calculate();
            },
            onItemDeleted: function (args) {
                calculate();
            },
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
                {type: "control"}
            ]
        });

         // on save: retrieve grid and submit
         $('#save').on('click', function (e) {
            var action = $('#journal'),
                grid = $("#jsGrid").jsGrid("option", "data");

            $('#entries').val(JSON.stringify(grid));
            action.submit();
        });

        // calculate
        var calculate = function () {
            var dr_amt = $('#dr_total'),
                cr_amt = $('#cr_total'),
                items = $("#jsGrid").jsGrid("option", "data"),
                math = {debit: 0, credit: 0};
            items.forEach(function (item) {
                if (item.debit_account_id > 0) math.debit += parseFloat(item.amount);
                if (item.credit_account_id > 0) math.credit += parseFloat(item.amount);
            });
            // update output fields
            dr_amt.val(math.debit.toFixed(2));
            cr_amt.val(math.credit.toFixed(2));
        }
    });

</script>
@endpush
