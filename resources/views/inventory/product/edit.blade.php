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
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('name')) ? old('name') : $data->name
                                        @endphp
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="eg. HD Monitor"
                                               required value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('quantity')) ? old('quantity') : $data->quantity
                                        @endphp
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" placeholder="eg. 500" name="quantity"
                                               value="{{ $_value }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('stock_threshold')) ? old('stock_threshold') : $data->stock_threshold
                                        @endphp
                                        <label for="stock_threshold">Stock Threshold</label>
                                        <input type="text" class="form-control" name="stock_threshold" id="stock_threshold"
                                               placeholder="eg. 250" value="{{ $_value }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('expiry_date')) ? old('expiry_date') : $data->expiry_date
                                        @endphp
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" class="form-control" name="expiry_date" id="expiry_date"
                                               value="{{ $_value }}">
                                    </div>
                                    <div class=" form-group col-md-4">
                                        @php
                                            $_value = !empty(old('cost_price')) ? old('cost_price') : $data->cost_price
                                        @endphp
                                        <label for="cost_price">Cost Price (GH¢)</label>
                                        <input type="text" class="form-control" name="cost_price" placeholder="eg. 2000" id="cost_price"
                                               value="{{ $_value }}" required>
                                    </div>
                                    <div class=" form-group col-md-4">
                                        @php
                                            $_value = !empty(old('selling_price')) ? old('selling_price') : $data->selling_price
                                        @endphp
                                        <label for="selling_price">Selling Price (GH¢)</label>
                                        <input type="text" class="form-control" name="selling_price" placeholder="eg. 2100"
                                               id="selling_price" value="{{ $_value }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        @php
                                            $_value = !empty(old('location')) ? old('location') : $data->location
                                        @endphp
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" id="location" value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('category_id')) ? old('category_id') : $data->category_id
                                        @endphp
                                        <label for="category_id">Category</label>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="">-- Select A Category ---</option>
                                            @foreach($categories as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $_value  ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row col-md-12 text-center mt-5">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
