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

                        <form method="post">
                            @csrf
                            <input type="text" value="owing" name="type" hidden>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="expense_no">Expense No.</label>
                                    <input type="text" class="form-control" placeholder="Auto Generated" id="expense_no"
                                        value="{{ $data->expense->expense_no }}" disabled>
                                </div>
                                <div class=" form-group col-md-3">
                                    <label for="total_amount">Total Amount</label>
                                    <input type="text" class="form-control" name="total_amount" placeholder="eg. 2000"
                                        id="total_amount" value="{{ $data->expense->total_amount }}" disabled>
                                </div>
                                <div class=" form-group col-md-3">
                                    <label for="amount_remaining">Balance Due</label>
                                    <input type="text" class="form-control" id="balance_due"
                                        value="{{ $data->new_balance }}" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('payment_date')) ? old('payment_date') :
                                    $data->payment_date->toDateString()
                                    @endphp
                                    <label for="payment_date">Payment Date</label>
                                    <input type="date" class="form-control" id="payment_date" name="payment_date"
                                        value="{{ $_value }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class=" form-group col-md-3">
                                    @php
                                    $_value = !empty(old('amount_paid')) ? old('amount_paid') : $data->amount_paid
                                    @endphp
                                    <label for="cost_price">Amount Paid</label>
                                    <input type="text" class="form-control" name="amount_paid" placeholder="eg. 2000"
                                        id="amount_paid" value="{{  $_value }}" required>
                                </div>
                                <div class=" form-group col-md-3">
                                    @php
                                    $_value = !empty(old('new_balance')) ? old('new_balance') : $data->new_balance
                                    @endphp
                                    <label for="amount_remaining">Amount Remaining</label>
                                    <input type="text" class="form-control" name="amount_remaining"
                                        placeholder="eg. 2000" id="amount_remaining"
                                        value="{{ $_value }}" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('description')) ? old('description') : $data->description
                                    @endphp
                                    <label for="description">Description</label>
                                    <textarea type="description" class="form-control" id="description"
                                        name="description">{{ $_value }}</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="form-row col-md-12 text-center mt-5 mb-5">
                                <button type="submit" id="save" class="btn btn-primary mb-5">Save Changes</button>
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
<script>
    $(document).ready(function(){
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
