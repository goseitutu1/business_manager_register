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

                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="category-name">Name</label>
                                    <input type="text" class="form-control" id="category-name" name="name"
                                           placeholder="eg. Hair Dressing" value="{{ $data->name }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="category-name">Amount</label>
                                    <input type="text" class="form-control" id="category-name" name="amount"
                                           placeholder="eg. 200" value="{{ $data->amount }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="category_id">Category</label>
                                    <input type="text" class="form-control" id="category_id" placeholder="eg. 250"
                                           value="{{ $data->category->name }}" disabled>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <a onclick="javascript:history.go(-1)" class="btn btn-primary text-white mt-5">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
