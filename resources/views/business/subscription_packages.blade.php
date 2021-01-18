<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>MTN Business Manager Lite</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="description" content="Our new innovation for SME's">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        @font-face {
            font-family: "MTNBrighterSans-Regular";
            src: url("{{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}}");
        }
    </style>

    <link rel="stylesheet" href="{{asset('UI/css/style.css')}}">
    <style type="text/css">
        body {
            background: linear-gradient(to right, #ffc423, #ffc423);
        }
        section.pricing {
            background: #ffc423;
            background: linear-gradient(to right, #ffc423, #ffc423);
        }

        .pricing .card {
            border: none;
            border-radius: 1rem;
            transition: all 0.2s;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .pricing hr {
            margin: 1.5rem 0;
        }

        .pricing .card-title {
            margin: 0.5rem 0;
            font-size: 0.9rem;
            letter-spacing: .1rem;
            font-weight: bold;
        }

        .pricing .card-price {
            font-size: 2.3rem;
            margin: 0;
            font-family: "MTNBrighterSans-Regular";
            src: url("{{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}}");
        }

        .pricing .card-price .period {
            font-size: 0.8rem;
            font-family: "MTNBrighterSans-Regular";
            src: url("{{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}}");
        }

        .pricing ul li {
            margin-bottom: 1rem;
        }

        .pricing .text-muted {
            opacity: 0.7;
        }

        .pricing .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            opacity: 0.7;
            transition: all 0.2s;
        }

        /* Hover Effects on Card */

        @media (min-width: 992px) {
            .pricing .card:hover {
                margin-top: -.25rem;
                margin-bottom: .25rem;
                box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
            }

            .pricing .card:hover .btn {
                opacity: 1;
            }
        }

    </style>

</head>

<body style="font-family: 'MTNBrighterSans-Regular' !important; overflow: scroll">
<div class="container-fluid">
    <div class="text-center my-4">
        <h3>Choose Subscription Package</h3>
    </div>
    <section class="pricing py-5">
        <div class="container">
            <div class="row">
                @php
                    $subscription = auth()->user()->subscription;
                @endphp
                @foreach ($plans as $plan)
                    <div class="col-lg-3">
                        <div class="card mb-5 mb-lg-0">
                            <div class="card-body">
                                <h5 class="card-title text-muted text-uppercase text-center">
                                    {{ $plan->name }}</h5>
                                <h6 class="card-price text-center">GHC {{ $plan->price }}<span
                                        class="period">/month</span></h6>
                                <hr>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>1 -
                                        {{ $plan->maximum_employees }}{{ $plan->has_employees_limit ? "" : "+" }}
                                        Employees across all businesses
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Inventory
                                        Management
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Sales
                                        Management
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Expense
                                        Management
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Finance
                                        Management
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Customer
                                        Management
                                    </li>
                                    <li><span class="fa-li"><i class="fa fa-check"></i></span>Business
                                        &
                                        Human Resource Management
                                    </li>
                                </ul>
                                @if(@$subscription->plan_id != null )
                                    @if($subscription->plan_id == $plan->id )
                                        <p class="btn btn-block font-weight-bold text-uppercase">
                                            Current Plan</p>
                                    @else
                                        <a class="btn btn-block btn-primary text-uppercase subscribe-plan"
                                           data-plan="{{  $plan->id_hash }}"
                                           data-price="{{ $plan->price }}" href="{{ route('subscription.plan.activate', ['planId'=>$plan->id_hash]) }}">Subscribe</a>
                                    @endif
                                @else
                                    <a class="btn btn-block btn-primary text-uppercase subscribe-plan"
                                       data-plan=" {{  $plan->id_hash }}" href="{{ route('subscription.plan.activate', ['planId'=>$plan->id_hash]) }}"
                                       data-price="{{ $plan->price }}">Subscribe</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="text-center my-4">
        <h4><a href="{{ route('dashboard') }}">Proceed to Dashboard <span class="fa fa-arrow-right"></span></a></h4>
    </div>
</div>
</body>
</html>
