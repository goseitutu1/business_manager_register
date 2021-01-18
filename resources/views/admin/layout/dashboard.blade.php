@extends('admin.layout.master')

@push('styles')
<style>
    .dbox {
        position: relative;
        background: rgb(255, 86, 65);
        background: -moz-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5641', endColorstr='#fd3261', GradientType=0);
        border-radius: 4px;
        text-align: center;
        margin: 60px 0 50px;
    }

    .dbox__icon {
        position: absolute;
        transform: translateY(-50%) translateX(-50%);
        left: 50%;
    }

    .dbox__icon:before {
        width: 75px;
        height: 75px;
        position: absolute;
        background: #fda299;
        background: rgba(253, 162, 153, 0.34);
        content: '';
        border-radius: 50%;
        left: -17px;
        top: -17px;
        z-index: -2;
    }

    .dbox__icon:after {
        width: 60px;
        height: 60px;
        position: absolute;
        background: #f79489;
        background: rgba(247, 148, 137, 0.91);
        content: '';
        border-radius: 50%;
        left: -10px;
        top: -10px;
        z-index: -1;
    }

    .dbox__icon>i {
        background: #ff5444;
        border-radius: 50%;
        line-height: 40px;
        color: #FFF;
        width: 40px;
        height: 40px;
        font-size: 22px;
    }

    .dbox__body {
        padding: 50px 20px;
    }

    .dbox__count {
        display: block;
        font-size: 30px;
        color: #FFF;
        font-weight: 300;
    }

    .dbox__title {
        font-size: 13px;
        color: #FFF;
        color: rgba(255, 255, 255, 0.81);
    }

    .dbox__action {
        transform: translateY(-50%) translateX(-50%);
        position: absolute;
        left: 50%;
    }

    .dbox__action__btn {
        border: none;
        background: #FFF;
        border-radius: 19px;
        padding: 7px 16px;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 11px;
        letter-spacing: .5px;
        color: #003e85;
        box-shadow: 0 3px 5px #d4d4d4;
    }


    .dbox--color-2 {
        background: rgb(252, 190, 27);
        background: -moz-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
        background: -webkit-linear-gradient(top, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
        background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fcbe1b', endColorstr='#f85648', GradientType=0);
    }

    .dbox--color-2 .dbox__icon:after {
        background: #fee036;
        background: rgba(254, 224, 54, 0.81);
    }

    .dbox--color-2 .dbox__icon:before {
        background: #fee036;
        background: rgba(254, 224, 54, 0.64);
    }

    .dbox--color-2 .dbox__icon>i {
        background: #fb9f28;
    }

    .dbox--color-3 {
        background: #005C97;
        background: -webkit-linear-gradient(to right, #363795, #005C97);
        background: linear-gradient(to right, #363795, #005C97);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
    }

    .dbox--color-3 .dbox__icon:after {
        background: #005C97;
        background: -webkit-linear-gradient(to right, #363795, #005C97);
        background: linear-gradient(to right, #363795, #005C97);

    }

    .dbox--color-3 .dbox__icon:before {
        background: #005C97;
        background: rgba(0, 94, 153, 0.65);
    }

    .dbox--color-3 .dbox__icon>i {
        background: #005C97;
    }



    .dbox--color-4 {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #52c234, #061700);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
    }

    .dbox--color-4 .dbox__icon:after {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #52c234, #061700);

    }

    .dbox--color-4 .dbox__icon:before {
        background: #005C97;
        background: linear-gradient(to right, #52c234, #061700);
    }

    .dbox--color-4 .dbox__icon>i {
        background: #52c234;
    }



    .dbox--color-5 {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #485563, #29323c);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
    }

    .dbox--color-5 .dbox__icon:after {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #485563, #29323c);

    }

    .dbox--color-5 .dbox__icon:before {
        background: #005C97;
        background: linear-gradient(to right, #485563, #29323c);
    }

    .dbox--color-5 .dbox__icon>i {
        background: #485563;
    }



    .dbox--color-6 {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #aa076b, #61045f);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b747f7', endColorstr='#6c53dc', GradientType=0);
    }

    .dbox--color-6 .dbox__icon:after {
        background: #005C97;
        /*background: -webkit-linear-gradient(to right, #363795, #005C97);*/
        background: linear-gradient(to right, #aa076b, #61045f);

    }

    .dbox--color-6 .dbox__icon:before {
        background: #005C97;
        background: linear-gradient(to right, #aa076b, #61045f);
    }

    .dbox--color-6 .dbox__icon>i {
        background: #aa076b;
    }
</style>
@endpush

@section('content')
<div class="content-body">
    <!-- Chart -->
    <div class="row match-height">
        <div class="col-12">
            <div class="">
                <!-- line chart section start -->
                <section id="chartjs-line-charts">
                    <!-- Line Chart -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Welcome, {{ auth()->user()->full_name }}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="dbox dbox--color-1">
                                                    <div class="dbox__icon">
                                                        <i class="la la-users"></i>
                                                    </div>

                                                    <div class="dbox__body">
                                                        <span class="dbox__count">{{ $users }}</span>
                                                        <span class="dbox__title">Total Users</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="dbox dbox--color-2">
                                                    <div class="dbox__icon">
                                                        <i class="la la-bullhorn"></i>
                                                    </div>

                                                    <div class="dbox__body">
                                                        <span class="dbox__count">{{ $ads }}</span>
                                                        <span class="dbox__title">Total Adverts</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="dbox dbox--color-3">
                                                    <div class="dbox__icon">
                                                        <i class="la la-money"></i>
                                                    </div>

                                                    <div class="dbox__body">
                                                        <span class="dbox__count">{{ $subscription_payments }}</span>
                                                        <span class="dbox__title">Subscription Payment (today)</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"
                                            onclick="window.location = '{{ route('admin.customer_support.feedback.index', ['status' => 'pending']) }}'">
                                            <div class="col-md-4">
                                                <div class="dbox dbox--color-4">
                                                    <div class="dbox__icon">
                                                        <i class="la la-info-circle"></i>
                                                    </div>

                                                    <div class="dbox__body">
                                                        <span class="dbox__count">{{ $pending_feedback }}</span>
                                                        <span class="dbox__title">Pending Complaints</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- Chart -->

    <div class="card">
        <div class="card-content">
            <div class="card-body chartjs">
                <div class="height-400">
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
