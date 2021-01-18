@extends('auth.register')
@section('content')
    <form class="panel__body" method="post" enctype="multipart/form-data">
        @csrf
        <div class="sign text-center">
            <p class="sign__input" style="margin-top: -4em">Create New Business</p>
            @if($errors)
                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                @endforeach
            @endif
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">
                        {{ Session::get('alert-' . $msg) }}
                    </p>
                @endif
            @endforeach
            <div class="form-group">
                <label for="email" class="sr-only">enter business name (mandatory)</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Business Name (mandatory)"
                       value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="location" class="sr-only">enter business location (mandatory)</label>
                <input type="text" class="form-control" name="location" id="location" placeholder="Business Location (mandatory)"
                       value="{{ old('location') }}" required>
            </div>
            <div class="form-group">
                <label for="type" class="sr-only">enter the nature of business (mandatory)</label>
                <input type="text" class="form-control" name="type" id="type" placeholder="Nature of Business (mandatory)"
                       value="{{ old('type') }}" required>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="reg_no" class="sr-only">enter business registration number</label>--}}
{{--                <input type="text" class="form-control" name="reg_no" id="reg_no"--}}
{{--                       placeholder="Business Registration No. (optional)"--}}
{{--                       value="{{ old('reg_no') }}">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="tax_no" class="sr-only">enter business tax number</label>--}}
{{--                <input type="text" class="form-control" name="tax_no" id="tax_no"--}}
{{--                       placeholder="Business Tax No. (optional)"--}}
{{--                       value="{{ old('tax_no') }}">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label for="vat_no" class="sr-only">enter business VAT number</label>--}}
{{--                <input type="text" class="form-control" name="vat_no" id="vat_no"--}}
{{--                       placeholder="Business VAT No. (optional)"--}}
{{--                       value="{{ old('vat_no') }}">--}}
{{--            </div>--}}
{{--            <div class="form-row">--}}
{{--                <label for="logo" class="sr-only">choose business logo</label>--}}
{{--                <div class="custom-file">--}}
{{--                    <input type="file" class="custom-file-input" name="logo" id="logo" value="{{ old('logo') }}"--}}
{{--                           accept=".png, .jpg, .jpeg">--}}
{{--                    <label class="custom-file-label" for="logo">Business Logo</label>--}}
{{--                </div>--}}
{{--                <img src="{{ asset('images/img-placeholder.png') }}" alt="" id="logo-preview"--}}
{{--                     class="rounded img-thumbnail" height="30px">--}}
{{--            </div>--}}
        </div>

        <div class="option text-center">
            <div class="option__item">
                <button type="submit" class="button">Create Business</button>
            </div>
        </div>
    </form>
@endsection
