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
                                <div class="form-group col-md-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="eg. John" required value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="eg. Doe" required value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Email (optional)</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="eg. johndoe@npontu.com" name="email" value="{{ old('email') }}" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="date_of_birth">Date of Birth (optional)</label>
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        value="{{ old('date_of_birth') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="eg. 0244346545"
                                        name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="address">Residential Address (optional)</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value="{{ old('address') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="location">Location (optional)</label>
                                    <input type="text" class="form-control" name="location" id="location"
                                        value="{{ old('location') }}">
                                </div>
                            </div>
                            <input type="text" hidden value="false" name="save_and_apply" id="save_and_apply">
                            <div class="form-row col-md-12 text-center mt-1">
                                <button type="submit" class="btn btn-primary" id="save">Save</button>
                                <button type="submit" class="btn btn-primary ml-2" id="apply">Save & Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
