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

                        <form method="post" id="form">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="eg. HD Monitor"
                                        disabled value="{{ $data->name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" placeholder="eg. 500"
                                        value="{{ $data->quantity }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="stock_threshold">Stock Reorder Level</label>
                                    <input type="text" class="form-control" id="stock_threshold" placeholder="eg. 250"
                                        value="{{ $data->stock_threshold }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" class="form-control" id="expiry_date"
                                        value="{{ $data->expiry_date }}" disabled>
                                </div>
                                <div class=" form-group col-md-4">
                                    <label for="cost_price">Cost Price (GH¢)</label>
                                    <input type="text" class="form-control" name="cost_price" placeholder="eg. 2000"
                                        id="cost_price" value="{{ $data->cost_price }}" disabled>
                                </div>
                                <div class=" form-group col-md-4">
                                    <label for="selling_price">Selling Price (GH¢)</label>
                                    <input type="text" class="form-control" name="selling_price" placeholder="eg. 2100"
                                        id="selling_price" value="{{ $data->selling_price }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category_id">Category</label>
                                    <input type="text" class="form-control" id="category_id" placeholder="eg. 250"
                                        value="{{ $data->category->name }}" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="location">Shelf</label>
                                    <input type="text" class="form-control" id="location" value="{{ $data->location }}"
                                        disabled>
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
