@extends('UI_new.master')
@push('styles')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> --}}
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
                            <p><span class="text-bold-600"><i class="la la-info"></i></span> {{$page->section}}</p>

                            <form method="post" id="sales">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="cost_price">Payment No.</label>
                                        <input type="text" class="form-control" placeholder="Auto Generated" id="payment_no"
                                               value="{{ $data->payment_no }}" disabled>
                                    </div>
                                    <div class="form-group  col-md-3 mb-3">
                                        @php
                                            $_value = !empty(old('total_amount')) ? old('total_amount') : $data->total_amount
                                        @endphp
                                        <label class="control-label">Total Amount</label>
                                        <input type="text" name="total_amount" id="total_amount" value="{{ $_value }}"
                                               class="form-control text-right" readonly placeholder="0">
                                    </div>
                                    <div class=" form-group col-md-3">
                                        @php
                                            $_value = !empty(old('amount_paid')) ? old('amount_paid') : $data->amount_paid
                                        @endphp
                                        <label for="cost_price">Amount Paid</label>
                                        <input type="text" class="form-control" name="amount_paid" placeholder="eg. 2000"
                                               id="amount_paid" value="{{  $_value }}" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        @php
                                            $_value = !empty(old('payment_method')) ? old('payment_method') : $data->payment_method
                                        @endphp
                                        <label for="payment_method">Payment Method</label>
                                        <select class="form-control" name="payment_method" id="payment_method">
                                            <option value="">-- Select Payment Method ---</option>
                                            {{-- <option value="momo-pay" {{ $_value == 'momo-pay' ? 'selected': '' }}>Mobile
                                                Money</option> --}}
                                            <option value="cash" {{ $_value == 'cash' ? 'selected': '' }}>Cash</option>
                                            {{-- <option value="bank" {{ $_value == 'bank' ? 'selected': '' }}>Bank</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        @php
                                            $_value = !empty(old('customer_id')) ? old('customer_id') : $data->customer->id
                                        @endphp

                                        <label for="customer_id">Customer</label>
                                        <select class="form-control" name="customer_id" id="customer_id">
                                            <option value="">-- Select A Customer ---</option>
                                            @foreach($customers as $item)
                                                <option value="{{ @$item->id }}" {{ $item->id == $_value ? 'selected' : '' }}>
                                                    {{ $item->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        @php
                                            $_value = !empty(old('discount_type')) ? old('discount_type') : $data->discount_type
                                        @endphp

                                        <label for="discount_type">Discount Type</label>
                                        <select class="form-control" name="discount_type" id="discount_type">
                                            <option value="">-- Select Discount Type ---</option>
                                            <option value="fixed" {{ $_value == 'fixed' ? 'selected': '' }}>Fixed</option>
                                            <option value="percentage" {{ $_value == 'percentage' ? 'selected': '' }}>
                                                Percentage</option>
                                        </select>
                                    </div>
                                    <div class=" form-group col-md-3">
                                        @php
                                            $_value = !empty(old('discount_value')) ? old('discount_value') : $data->discount_value
                                        @endphp

                                        <label for="cost_price">Discount (optional)</label>
                                        <input type="text" class="form-control" name="discount_value" placeholder="eg. 2000"
                                               id="discount_value" value="{{ $_value }}">
                                    </div>
                                    <div class=" form-group col-md-3">
                                        @php
                                            $val = $data->due_date;
                                            $_value = !empty(old('due_date')) ? old('due_date') : ($val != null) ?  $data->due_date->toDateString() : '';
                                        @endphp
                                        <label for="due_date">Due Date</label>
                                        <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $_value }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="payment_completed">Payment Completed?</label>
                                        <select class="form-control" name="payment_completed" id="payment_completed">
                                            <option value="true" {{ old('payment_completed') == true  ? 'selected': '' }}>
                                                Yes
                                            </option>
                                            <option value="false" {{ old('payment_completed') == true  ? 'selected': '' }}>
                                                No
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row col-md-12 text-center mt-5 mb-5">
                                    <button type="submit" class="btn btn-primary mb-5">Save Changes</button>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
<script>
    $(document).ready(function(){
        $('#customer_id').select2();
    });
</script>
@endpush
