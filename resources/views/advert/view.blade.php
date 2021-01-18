@extends('UI_new.master')

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

                        <form>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title"
                                        value="{{ $data->title }}" disabled>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Status</label>
                                    <input type="text" class="form-control" placeholder="Status"
                                        value="{{ $data->status->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label>Feature Image : <em style="font-size: 0.8em;color:red">Dimensions: 7360px X
                                            3119px</em></label>
                                    <img class="img img-rounded"
                                        src="{{ is_null($data->feature_image) ? asset('UI/images/backgrounds/dash.jpg') : asset('adverts/'.$data->feature_image) }}"
                                        class="d-block w-100" alt="...">
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
