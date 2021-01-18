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


                            <form method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="eg. John"
                                               disabled value="{{ $data->first_name }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="eg. Doe"
                                               disabled value="{{ $data->last_name }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="eg. johndoe@npontu.com"
                                               name="email" value="{{ $data->email }}" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" class="form-control" placeholder="eg. 0244346545" name="phone_number"
                                               id="phone_number" value="{{ $data->phone_number }}" disabled>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" name="location" id="location"
                                               value="{{ $data->location }}" disabled>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="description">Description</label>
                                        <textarea type="text" class="form-control" name="description" id="description"
                                                  value="{{ $data->description }}" disabled> {{ $data->description }} </textarea>
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
