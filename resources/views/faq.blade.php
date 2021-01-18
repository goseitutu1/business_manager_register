@extends('UI_new.master')

@section('content')
    <div class="content-body" style="margin-top: 5em">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">FAQ</h4>
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
                            <p><span class="text-bold-600"><i class="la la-info"></i></span> Frequently Asked Questions</p>

                            <div class="accordion" id="accordionExample">

                                @forelse($faq as $faqz)
                                <div class="card mb-1">
                                    <div id="headingOne" style="cursor: pointer">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$faqz->id}}" aria-expanded="true" aria-controls="collapse{{$faqz->id}}">
                                                {{$faqz->question}}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapse{{$faqz->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="text-left mt-1">
                                            <p style="margin-left: 2em"> {{$faqz->answer}} </p>
                                        </div>
                                    </div>
                                </div>
                                @empty

                                <div class="card">
                                    <div class="card-header">
                                        FAQ
                                    </div>
                                    <div class="card-body">
                                        <p align="center">
                                            There are no FAQs yet
                                        </p>
                                    </div>
                                </div>
                                    @endforelse
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--{{$dataTable->table()}}--}}
@endsection
