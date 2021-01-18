@extends('UI_new.master')

@section('content')
{{-- <div class="basic-login-form-ad">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="modal-bootstrap modal-login-form float-right"
                style="float: right">
                <a class="zoomInDown mg-t" href="#" data-toggle="modal"
                    data-target="#zoomInDown1">Create</a>
            </div>
            <div id="zoomInDown1" class="modal modal-edu-general
                modal-zoomInDown fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i
                                    class="fa fa-close mr-1 mt-1"></i></a>
                        </div>
                        <div class="modal-body">
                            <div class="modal-login-form-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12
                                        col-xs-12">
                                        <div class="basic-login-inner
                                            modal-basic-inner">
                                            <form action="{{
                                                route('expense.category.create')}}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="login2">Name</label>
                                                    <input type="text"
                                                        name="name"
                                                        class="form-control"
                                                        placeholder="Category
                                                        Name"
                                                        value="{{ old('name')
                                                        }}" />
                                                </div>
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-4
                                                            col-md-4 col-sm-4
                                                            col-xs-12">
                                                        </div>
                                                        <div class="col-lg-8
                                                            col-md-8 col-sm-8
                                                            col-xs-12">
                                                            <div
                                                                class="login-horizental">
                                                                <button
                                                                    class="btn
                                                                    btn-sm
                                                                    btn-primary
                                                                    login-submit-cs"
                                                                    type="submit">Create</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="content-body" style="margin-top: 5em">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$page->title}}</h4>
                    <a class="heading-elements-toggle"><i class="la
                            la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-md-12 text-right">
                    <a class="zoomInDown mg-t btn btn-primary" href="#"
                        data-toggle="modal"
                        data-target="#zoomInDown1"><span class="fa fa-plus"></span>
                        Add</a>
                </div> --}}
                <div class="card-content">
                    <div class="card-body">
                        <p><span class="text-bold-600"><i class="la la-info"></i></span>
                            {{$page->section}}</p>

                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{$dataTable->scripts()}}
@endpush
