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
                @if (!empty($errors))
                    @if (count($errors) > 0)
                    <div class=" alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors as $items)
                                    @foreach ($items['errors'] as $error)
                                    <li>Row {{ $items['row'] - 1  }}: {{ $error }}</li>
                                    @endforeach
                                @endforeach
                            </ul>
                    </div>
                    @endif
                @endif
                <div class="offset-md-9 col-md-3">
                    <form method="post" enctype="multipart/form-data" action="{{ route('inventory.product.import') }}"
                        id="form">
                        @csrf
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             Import
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('inventory.product.download_template') }}">Download Template</a>
                                <a class="dropdown-item" href="#" id="option_import">Select Upload File</a>
                            </div>
                        </div>

                        <input type="file" id="import_file" type="file" accept=".xlsx, .xls, .csv" name="file"
                            value="{{  old('file') }}" hidden/>
                    </form>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p><span class="text-bold-600"><i class="ft-info"></i></span> {{$page->section}}</p>

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

<script type="text/javascript">
    $(function () {
        var fileupload = $("#import_file");
        var button = $("#option_import");
        button.click(function () {
            fileupload.click();
        });
        fileupload.change(function () {;
            $("#form").submit();
        });
    });
</script>
@endpush
