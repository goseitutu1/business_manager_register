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
                                             @if(Request::is('journal/accounts'))
                                        <p>
                                            <span class="text-bold-600"
                                             data-toggle="tooltip" data-placement="top" title="A ledger is a book containing accounts in which the
                                    classified and summarized information from the journals is posted as debits and credits. It is also called the second book of entry.
                                    The ledger contains the information that is required to prepare financial statements.">
                                            <i class="la la-info"></i></span>
                                            {{$page->section}}
                                    </p>


                                             @elseif(Request::is('journal/general-journal'))
                                                 <p>
                                        <span class="text-bold-600"
                                              data-toggle="tooltip" data-placement="top" title="A journal is a detailed account that records all the financial
                                               transactions of a business, to be used for future reconciling of and transfer to other official accounting
                                               records, such as the general ledger.">
                                            <i class="la la-info"></i></span>
                                                     {{$page->section}}
                                                 </p>
                                             @endif

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
