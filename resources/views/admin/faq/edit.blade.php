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

                        <form method="post" id="form">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    @php
                                    $_value = !empty(old('question')) ? old('question') : $data->question
                                    @endphp
                                    <label>Question</label>
                                    <input class="form-control" type="text" name="question" value="{{ $_value }}" required>
                                </div>
                                <div class="form-group col-md-12">
                                    @php
                                    $_value = !empty(old('answer')) ? old('answer') : $data->answer
                                    @endphp
                                    <label>Answer</label>
                                    <textarea rows="10" class="form-control" name="answer" required>{{ $_value }}</textarea>
                                </div>
                            <input type="text" hidden value="false" name="save_and_apply" id="save_and_apply">
                            <div class="form-row col-md-12 text-center mt-1">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
