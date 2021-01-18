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
                                <div class="col-md-3">
                                    <label for="category-name">Name</label>
                                    <input type="text" class="form-control" id="category-name" name="name"
                                        placeholder="eg. Hair Dressing" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="category-name">Amount</label>
                                    <input type="text" class="form-control" id="category-name" name="amount"
                                        placeholder="eg. 200" value="{{ old('amount') }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vendor_id">Category</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <a href="#" data-toggle="modal" data-target="#zoomInDown1">
                                                    <span class="fa fa-plus"></span>
                                                </a>
                                            </div>
                                        </div>
                                        <select class="form-control" name="category_id" id="category_id" required>
                                            <option value="">-- Select Category ---</option>
                                            @foreach($categories as $item)
                                            <option value="{{ @$item->id }}"
                                                {{ $item->id == old('category_id') ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden value="false" name="save_and_apply" id="save_and_apply">
                            <div class="form-row justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary" id="save">Save</button>
                                <button type="submit" class="btn btn-primary ml-5" id="apply">Save & Apply</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('inventory.category.modal')

@endsection
