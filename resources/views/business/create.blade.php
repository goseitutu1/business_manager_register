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

                            <form method="post" id="form" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="eg. Kings Venturs" required value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                               value="{{ old('location') }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="type">Nature of Business</label>
                                        <input type="text" class="form-control" name="type" id="type"
                                               placeholder="eg. Company" value="{{ old('type') }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="reg_no">Registration Number (optional)</label>
                                        <input type="text" class="form-control" name="reg_no" id="reg_no"
                                               placeholder="Business Registration No." value="{{ old('reg_no') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tax_no">Tax No. (optional)</label>
                                        <input type="text" class="form-control" name="tax_no" id="tax_no"
                                               placeholder="Business Tax No. " value="{{ old('tax_no') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="vat_no">VAT No. (optional)</label>
                                        <input type="text" class="form-control" name="vat_no" id="vat_no"
                                               placeholder="Business VAT No." value="{{ old('vat_no') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="currency">Currency</label>
                                        <select class="form-control" name="currency_id" id="currency">
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $item)
                                                <option value="{{ @$item->id }}"
                                                    {{ $item->id == old('currency_id') ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="logo">Choose Business Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" id="logo"
                                                   value="{{ old('logo') }}" accept=".png, .jpg, .jpeg">
                                            <label class="custom-file-label" for="logo">Business Logo</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <img src="{{ asset('images/img-placeholder.png') }}" id="logo-preview"
                                             class="img rounded img-thumbnail mt-1" height="20px">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary text-center">Create Business</button>
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
    <script type="text/javascript">
        $("#logo").change(function () {
            filePreview(this, $("#logo-preview"));
        });
    </script>
@endpush
