@extends('admin.layout.master')
@section('content')
<div class="content-body" style="margin-top: 5em">
    <div class="row">
        <div class="col-lg-12">
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

                        <form method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('name')) ? old('name') : @$data->name
                                    @endphp
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="eg. Starter" name="name"
                                        value="{{ $_value }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    @php
                                    $_value = !empty(old('price')) ? old('price') : $data->price
                                    @endphp
                                    <label for="price">Price (GHC)</label>
                                    <input type="text" class="form-control" id="price" placeholder="eg. 300"
                                        name="price" value="{{ $_value }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    @php
                                    $_value = !empty(old('description')) ? old('description') : $data->description
                                    @endphp
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description"
                                        id="description">{{ $_value }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('maximum_employees')) ? old('maximum_employees') :
                                    $data->maximum_employees
                                    @endphp
                                    <label>Maximum No. Employees</label>
                                    <input type="text" class="form-control" placeholder="eg. Starter"
                                        name="maximum_employees" value="{{ $_value }}" required>
                                </div>
                                <div class="form-group col-md-3">
                                    @php
                                    $_value = !empty(old('minimum_employees')) ? old('minimum_employees') :
                                    $data->minimum_employees
                                    @endphp
                                    <label>Minimum No. Employees</label>
                                    <input type="text" class="form-control" placeholder="eg. Starter"
                                        name="minimum_employees" value="{{ $_value }}" required>
                                </div>
                                <div class="form-group col-md-4 mt-3">
                                    @php
                                    $_value = !empty(old('has_employees_limit')) ? old('has_employees_limit') :
                                    $data->has_employees_limit;
                                    @endphp
                                    <label for="has_employees_limit">Employees No. Unlimited?</label>
                                    <input type="checkbox" {{ $_value == false ? "": "checked" }}
                                        value="true" name="has_employees_limit">
                                </div>
                            </div>

                            <div class="text-center mt-1">
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
