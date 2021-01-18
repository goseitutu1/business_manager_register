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
                                <div class="form-group col-md-4">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="eg. Kings Venturs" disabled value="{{ $data->name }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" name="location" id="location"
                                           value="{{ $data->location }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="type">Nature of Business</label>
                                    <input type="text" class="form-control" name="type" id="type"
                                           placeholder="eg. Company" value="{{ $data->type }}" disabled>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="reg_no">Registration Number</label>
                                    <input type="text" class="form-control" name="reg_no" id="reg_no"
                                           placeholder="Business Registration No." value="{{ $data->reg_no }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tax_no">Tax No. (optional)</label>
                                    <input type="text" class="form-control" name="tax_no" id="tax_no"
                                           placeholder="Business Tax No. " value="{{ $data->tax_no }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="vat_no">VAT No. (optional)</label>
                                    <input type="text" class="form-control" name="vat_no" id="vat_no"
                                           placeholder="Business VAT No." value="{{ $data->vat_no }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="currency">Currency</label>
                                    <input type="text" class="form-control" name="vat_no" id="vat_no"
                                           placeholder="Business VAT No." value="{{ $data->currency->name }}" disabled>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="logo" class="">Business Logo</label>
                                    <img src="{{ $data->logo }}" alt="{{ $data->name }} logo"
                                         class="img-thumbnail rounded" height="50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
