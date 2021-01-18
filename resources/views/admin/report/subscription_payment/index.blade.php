@extends('admin.layout.master')

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

                        <form class="form-inline mb-5 text-center" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="plan">Subscription Plan {{ old('plan') }}</label>
                                <select class="form-control mx-sm-2" id="plan" name="plan">
                                    <option value="">All Plans</option>
                                    @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}" {{ old('plan') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_date">From</label>
                                <input type="date" id="start_date" name="start_date" class="form-control mx-sm-2">
                            </div>
                            <div class="form-group">
                                <label for="end_data">To</label>
                                <input type="date" id="end_data" name="end_date" class="form-control mx-sm-2">
                            </div>

                            <button type="submit" id="submit" class="btn btn-primary my-1">Submit</button>
                        </form>
                        <div class="table-responsive">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

{{-- <script type='text/javascript'>
    $(document).ready(function(){
        $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
            data.plan     = $('[name=plan]').val();
            data.start_date  = $('[name=start_date]').val();
            data.end_date     = $('[name=end_date]').val();
            console.log("working");
            console.log("working");
            console.log("working");
            console.log("working");
        });

        $('#submit').click(function (event) {
            console.log('clicked');
            event.preventDefault();
            $('#dataTableBuilder').DataTable().ajax.reload();
        });
        $('#dataTableBuilder').DataTable().ajax.reload();

    })
</script> --}}
@endpush
