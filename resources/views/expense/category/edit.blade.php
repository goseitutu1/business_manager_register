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
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-sm-4 my-1">
                                            <label class="sr-only" for="category-name">Name</label>
                                            <input type="text" class="form-control" id="category-name" name="name" placeholder="Name"
                                                   value="{{ $data->name }}">
                                        </div>
                                        <div class="col-auto my-1">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
