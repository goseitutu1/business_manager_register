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

                        <form method="post" id="sales">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cost_price">Sales No.</label>
                                    <input type="text" class="form-control" placeholder="Auto Generated" id="sales_no"
                                        value="{{ $data->sales_no }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    @php
                                    $_value = $data->payment->type
                                    @endphp
                                    <label for="type">Sales Type</label>
                                    <select class="form-control" name="type" id="type" disabled>
                                        <option value="cash_sales"
                                            {{ preg_match('/paid|partial/i', $_value)  ? 'selected': '' }}>
                                            Cash Sales
                                        </option>
                                        <option value="credit_sales"
                                            {{ preg_match('/owing/i', $_value)  ? 'selected': '' }}>
                                            Credit Sales
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('customer_id')) ? old('customer_id') :
                                    @$data->payment->customer->id
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
                            </div>
                            <div class="row"></div>
                            @if (preg_match("/paid|partial/i", $data->payment->type))
                            <div class="form-row" id="cash-sales">
                                {{-- <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('payment_method')) ? old('payment_method') :
                                    $data->payment->payment_method
                                    @endphp
                                    <label for="payment_method">Payment Method</label>
                                    <select class="form-control" name="payment_method" id="payment_method">
                                        <option value="">-- Select Payment Method ---</option>
                                        <option value="momo-pay" {{ $_value == 'momo-pay' ? 'selected': '' }}>Mobile
                                Money</option>
                                <option value="cash" {{ $_value == 'cash' ? 'selected': '' }}>Cash</option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3" id="phone_number">
                                @php
                                $_value = !empty(old('phone_number')) ? old('phone_number') :
                                @$data->payment->phone_number
                                @endphp
                                <label for="phone_number">Mobile Money Number</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="eg. 0248895123"
                                    value="{{ $_value }}" required>
                            </div> --}}
                            <div class=" form-group col-md-3">
                                @php
                                $_value = !empty(old('amount_paid')) ? old('amount_paid') :
                                $data->payment->amount_paid
                                @endphp
                                <label for="cost_price">Amount Paid</label>
                                <input type="text" class="form-control" name="amount_paid" placeholder="eg. 2000"
                                    id="amount_paid" value="{{  $_value }}" required>
                            </div>
                            <div class="form-group col-md-3">
                                @php
                                $_value = !empty(old('discount_type')) ? old('discount_type') :
                                $data->payment->discount_type
                                @endphp
                                <label for="expiry_date">Discount Type</label>
                                <select class="form-control" name="discount_type" id="discount_type">
                                    <option value="">-- Select Discount Type ---</option>
                                    <option value="fixed" {{ $_value == 'fixed' ? 'selected': '' }}>Fixed</option>
                                    <option value="percentage" {{ $_value == 'percentage' ? 'selected': '' }}>
                                        Percentage</option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3">
                                @php
                                $_value = !empty(old('discount_value')) ? old('discount_value') :
                                $data->payment->discount_value
                                @endphp

                                <label for="cost_price">Discount (optional)</label>
                                <input type="text" class="form-control" name="discount_value" placeholder="eg. 2000"
                                    id="discount_value" value="{{ $_value }}" required>
                            </div>

                    </div>
                    @endif

                    @if ($data->payment->type == "owing")
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            @php
                            $_value = !empty(old('due_date')) ? old('due_date') : $data->payment->due_date->toDateString()
                            @endphp
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date" value="{{ $_value }}"
                                required>
                        </div>
                    </div>
                    @endif

                    <input type="hidden" id="items" name="items" value="{{ old('items') }}" />
                    <div class="row">
                        <div id="jsGrid"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            @php
                            $_value = !empty(old('total')) ? old('total') : $data->total
                            @endphp
                            <label class="control-label">Total</label>
                            <input type="text" name="total" id="total" value="{{ $_value }}"
                                class="form-control text-right" readonly placeholder="0">
                        </div>
                        <div class="form-group  col-md-4">
                            @php
                            $_value = !empty(old('total_discount')) ? old('total_discount') : $data->total_discount
                            @endphp
                            <label class="control-label">Total Discount</label>
                            <input type="text" name="total_discount" id="total_discount" value="{{ $_value }}"
                                class="form-control text-right" readonly placeholder="0">
                        </div>
                        <div class="form-group  col-md-4">
                            @php
                            $_value = !empty(old('total_payable')) ? old('total_payable') : $data->total_payable
                            @endphp
                            <label class="control-label">Net Total</label>
                            <input type="text" name="total_payable" id="net_total" value="{{ $_value }}"
                                class="form-control text-right" readonly placeholder="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" id="btn_submit" class="btn btn-primary">Save Changes</button>
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
@include('sales.product.scripts')
