@extends('UI_new.master')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                            $_value = !empty(old('first_name')) ? old('first_name') : $data->first_name
                                        @endphp
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="eg. John"
                                               required value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('last_name')) ? old('last_name') : $data->last_name
                                        @endphp
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="eg. Doe"
                                               required value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('email')) ? old('email') : $data->email
                                        @endphp
                                        <label for="email">Email (optional)</label>
                                        <input type="email" class="form-control" id="email" placeholder="eg. johndoe@npontu.com"
                                               name="email" value="{{ $_value }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('phone_number')) ? old('phone_number') : $data->phone_number
                                        @endphp
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="eg. 0244346545" name="phone_number"
                                               id="phone_number" value="{{ $_value }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('location')) ? old('location') : $data->location
                                        @endphp
                                        <label for="location">Location (optional)</label>
                                        <input type="text" class="form-control" name="location" id="location" value="{{ $_value }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        @php
                                            $_value = !empty(old('description')) ? old('description') : $data->description
                                        @endphp
                                        <label for="description">Description (optional)</label>
                                        <textarea type="text" class="form-control" name="description" id="description">{{ $_value }}</textarea>
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
