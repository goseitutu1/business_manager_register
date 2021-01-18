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
                                    <input type="text" class="form-control" name="amount_paid"
                                        placeholder="Auto Generated" id="sales_no" value="{{ old('sales_no') }}"
                                        disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="type">Sales Type</label>
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="cash_sales" {{ old('type') == 'cash_sales' ? 'selected': '' }}>
                                            Cash Sales
                                        </option>
                                        <option value="credit_sales"
                                            {{ old('type') == 'credit_sales' ? 'selected': '' }}>
                                            Credit Sales
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="vendor_id">Customer</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <a
                                                    href="{{ route('customer.create', ['next' => route('sales.service.create', [], false)]) }}">
                                                    <span class="fa fa-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                        <select class="form-control" name="customer_id" id="customer_id">
                                            <option value="">-- Select Customer --</option>
                                            @foreach($customers as $item)
                                            <option value="{{ @$item->id }}"
                                                {{ $item->id == old('customer_id') ? 'selected' : '' }}>
                                                {{ $item->full_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                            <div class="form-row" id="cash-sales">
                                {{-- <div class="form-group col-md-3">
                            <label for="expiry_date">Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option value="">-- Select Payment Method ---</option>
                                <option value="momo-pay" {{ old('payment_method') == 'momo-pay' ? 'selected': '' }}>
                                Mobile
                                Money</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected': '' }}>Cash
                                </option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3" id="phone_number">
                                <label for="phone_number">Mobile Money Number</label>
                                <input type="text" class="form-control" name="phone_number" placeholder="eg. 0248895123"
                                    value="{{ old('phone_number') }}" required>
                            </div> --}}
                            <div class=" form-group col-md-3">
                                <label for="cost_price">Amount Paid</label>
                                <input type="text" class="form-control" name="amount_paid" placeholder="eg. 2000"
                                    id="amount_paid" value="{{ old('amount_paid') }}" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="expiry_date">Discount Type</label>
                                <select class="form-control" name="discount_type" id="discount_type">
                                    <option value="">-- Select Discount Type ---</option>
                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected': '' }}>
                                        Fixed</option>
                                    <option value="percentage"
                                        {{ old('discount_type') == 'percentage' ? 'selected': '' }}>
                                        Percentage</option>
                                </select>
                            </div>
                            <div class=" form-group col-md-3">
                                <label for="cost_price">Discount (optional)</label>
                                <input type="text" class="form-control" name="discount_value" placeholder="eg. 2000"
                                    id="discount_value" value="{{ old('discount_value') }}" required disabled>
                            </div>
                    </div>
                    <div class="form-row">
                        <div class=" form-group col-md-3" id="credit-sales">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" name="due_date" id="due_date"
                                value="{{ old('due_date') }}" required>
                        </div>
                    </div>
                    <input type="hidden" id="items" name="items" value="{{ old('items') }}" />
                    <div class="row">
                        <div id="jsGrid"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-4">
                            <label class="control-label">Total</label>
                            <input type="text" name="total" id="total" value="{{ old('total') }}"
                                class="form-control text-right" readonly placeholder="0">
                        </div>
                        <div class="form-group  col-md-4">
                            <label class="control-label">Total Discount</label>
                            <input type="text" name="total_discount" id="total_discount"
                                value="{{ old('total_discount') }}" class="form-control text-right" readonly
                                placeholder="0">
                        </div>
                        <div class="form-group  col-md-4">
                            <label class="control-label">Net Total</label>
                            <input type="text" name="net_total" id="net_total" value="{{ old('net_total') }}"
                                class="form-control text-right" readonly placeholder="0">
                        </div>
                    </div>

                    <input type="text" hidden value="false" name="save_and_apply" id="save_and_apply">
                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="btn_submit">Save</button>
                            <button type="submit" class="btn btn-primary ml-2" id="btn_apply">Save & Apply</button>
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
@include('sales.service.scripts')
