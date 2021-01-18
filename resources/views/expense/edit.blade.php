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
                        <div class="card-content">
                            <div class="card-body">
                                <p><span class="text-bold-600"><i class="la la-info"></i></span> {{$page->section}}</p>
                                <form method="post" action="{{route('expense.update', $expense->id)}}" id="form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" value="owing" name="type" hidden>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="expense_no">Expense No.</label>
                                            <input type="text" class="form-control" placeholder="Auto Generated"
                                                   id="expense_no" value="{{ $expense->expense_no }}" disabled>
                                        </div>
                                        <div class=" form-group col-md-3">
                                            <label for="total_amount">Total Amount</label>
                                            <input type="text" class="form-control" name="total_amount"
                                                   placeholder="eg. 2000" id="total_amount" value="{{ $expense->total_amount }}"
                                                   required>
                                        </div>
                                        <div class=" form-group col-md-3">
                                            <label for="cost_price">Amount Paid</label>
                                            <input type="text" class="form-control" name="amount_paid"
                                                   placeholder="eg. 2000" id="amount_paid" value="{{ $expense->amount_paid }}">
                                        </div>
                                        <div class=" form-group col-md-3">
                                            <label for="amount_remaining">Amount Remaining</label>
                                            <input type="text" class="form-control" name="amount_remaining"
                                                   placeholder="eg. 2000" id="amount_remaining"
                                                   value="{{ $expense->amount_remaining }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="type">Expense Type</label>
                                            <select class="form-control" name="type" id="type" required>
                                                <option value="paid" {{ $expense->type == 'paid' ? 'selected': '' }}>Paid Expense</option>
                                                <option value="owing" {{ $expense->type == 'owing' ? 'selected': '' }}>Owing Expense</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3" id="owing_expense">
                                            <label for="payment_date">Due Date</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date"
                                                   value="{{ \Carbon\Carbon::parse($expense->due_date)->format('Y-m-d') }}">
                                        </div>
                                        <div class="form-group col-md-3" id="paid_expense">
                                            <label for="payment_date">Payment Date</label>
                                            <input type="date" class="form-control" id="payment_date" name="payment_date"
                                                   value="{{ \Carbon\Carbon::parse($expense->payment_date)->format('Y-m-d') }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">-- Select A Category ---</option>
                                                @foreach($categories as $item)
                                                    <option value="{{ @$item->id }}"
                                                        {{ $item->id == $expense->category_id ? 'selected' : '' }}>{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="vendor_id">Vendor</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <a
                                                            href="{{ route('suppliers.create', ['next' => route('expense.create', [], false)]) }}">
                                                            <span class="fa fa-plus"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <select class="form-control" name="vendor_id" id="vendor_id" required>
                                                    <option value="">-- Select Vendor ---</option>
                                                    @foreach($vendors as $item)
                                                        <option value="{{ @$item->id }}"
                                                            {{ $item->id == $expense->vendor_id ? 'selected' : '' }}>
                                                            {{ $item->full_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="description">Description</label>
                                            <textarea type="description" class="form-control" id="description"
                                                      name="description">{{ $expense->description }}</textarea>
                                        </div>
                                    </div>

                                    <input type="text" hidden value="false" name="save_and_apply" id="save_and_apply">
                                    <div class="form-row col-md-12 text-center mt-1">
                                        <button type="submit" class="btn btn-primary" id="save">Save</button>
{{--                                        <button type="submit" class="btn btn-primary ml-2" id="apply">Save & Apply</button>--}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        // hide or show credit & cash sales forms based on the sales type
        function salesFormVisibility(){
            if($("#type").val() === "owing"){
                $('#owing_expense').show();
                $('#paid_expense').hide();
            }
            if($("#type").val() === "paid"){
                $('#owing_expense').hide();
                $('#paid_expense').show();
            }
        }

        $('#type').on('change',function () {
            salesFormVisibility();
        });

        $(document).ready(function(){
            salesFormVisibility();

            $('#category_id').select2({
                dropdownAutoWidth: true,
                theme: "bootstrap"
            });
            $('#vendor_id').select2({
                width: 'auto',
                dropdownAutoWidth: true,
                theme: "bootstrap"
            });

            $('#amount_paid').keyup(function(){
                let paid = parseFloat($(this).val()),
                    total = parseFloat($("#total_amount").val());

                let diff = (total - paid).toFixed(2);
                if(diff < 0){
                    alert("Amount remaining cannot be less than zero");
                } else {
                    $("#amount_remaining").val((total - paid).toFixed(2));
                }
            })
        })
    </script>
@endpush


