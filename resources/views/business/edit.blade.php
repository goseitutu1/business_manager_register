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
                                        @php
                                            $_value = !empty(old('name')) ? old('name') : $data->name
                                        @endphp
                                        <label for="business_name">Business Name (mandatory)</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="eg. Kings Venturs" required value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('location')) ? old('location') : $data->location
                                        @endphp
                                        <label for="location">Location (mandatory)</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                               value="{{ $_value }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('type')) ? old('type') : $data->type
                                        @endphp
                                        <label for="type">Nature of Business (mandatory)</label>
                                        <input type="text" class="form-control" name="type" id="type"
                                               placeholder="eg. Company" value="{{ $_value }}" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    @php
                                        $_value = !empty(old('reg_no')) ? old('reg_no') : $data->reg_no
                                    @endphp
                                    <div class="form-group col-md-4">
                                        <label for="reg_no">Registration Number (optional)</label>
                                        <input type="text" class="form-control" name="reg_no" id="reg_no"
                                               placeholder="Business Registration No." value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('tax_no')) ? old('tax_no') : $data->tax_no
                                        @endphp
                                        <label for="tax_no">Tax No. (optional)</label>
                                        <input type="text" class="form-control" name="tax_no" id="tax_no"
                                               placeholder="Business Tax No. " value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('vat_no')) ? old('vat_no') : $data->vat_no
                                        @endphp
                                        <label for="vat_no">VAT No. (optional)</label>
                                        <input type="text" class="form-control" name="vat_no" id="vat_no"
                                               placeholder="Business VAT No." value="{{ $_value }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('currency_id')) ? old('currency_id') : $data->currency_id
                                        @endphp
                                        <label for="currency">Currency</label>
                                        <select class="form-control" name="currency_id" id="currency">
                                            <option value="">Select Currency</option>
                                            @foreach($currencies as $item)
                                                <option value="{{ @$item->id }}"
                                                    {{ $item->id == $_value ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('logo')) ? old('logo') : $data->logo
                                        @endphp
                                        <label for="logo">Choose Business Logo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo" id="logo"
                                                   value="{{ $_value }}" accept=".png, .jpg, .jpeg">
                                            <label class="custom-file-label" for="logo">Business Logo</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <img src="{{ !empty($_value) ? $_value : asset('images/img-placeholder.png') }}"
                                             id="logo-preview"
                                             class="img rounded img-thumbnail mt-1" height="20px">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary text-center">Save Changes</button>
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
