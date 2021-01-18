@extends('UI_new.master')

@section('flash-message')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">
            {!! Session::get('alert-' . $msg) !!}
        </p>
        @endif
    @endforeach
</div>
<div>
    @if (!is_array($errors))
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    @endif
</div>
@endsection

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
{{--                <div class="col-md-12 text-right">--}}
{{--                    <a class="zoomInDown mg-t btn btn-primary" href="#" data-toggle="modal"--}}
{{--                       data-target="#zoomInDown1"><span class="fa fa-plus"></span> Make Payment</a>--}}
{{--                </div>--}}
                <div class="card-content">
                    <div class="card-body">
                        <p><span class="text-bold-600"><i class="la la-info"></i></span> {{$page->section}}</p>

                        <div class="table-responsive">
                            {{$dataTable->table()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal --}}
@include('subscription.payment_modal')

@endsection

@push('scripts')
{{$dataTable->scripts()}}
@endpush
