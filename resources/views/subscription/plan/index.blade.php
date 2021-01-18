@extends('UI_new.master')

@push('styles')
    <style>
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
@endpush

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

    {{-- modal --}}
    <div class="basic-login-form-ad">
        <div class="row">
            <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade pt-3 mt-5" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close mr-1 mt-1"></i></a>
                        </div>
                        <div class="modal-body">
                            <div class="modal-login-form-inner">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form action="{{ route('subscription.plan.create') }}" method="POST">

                                            <div class="basic-login-inner modal-basic-inner">
                                                @csrf
                                                <div class="form-group mt-1">
                                                    <label for="renewal_period">Renewal Period</label>
                                                    <select name="renewal_id"
                                                            id="renewal_period" class="form-control">
                                                        @foreach($renewal_periods as $period)
                                                            <option value="{{ $period->id }}"
                                                                    data-months="{{ $period->months }}">{{ $period->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="login2">Amount (GHC)</label>
                                                    <input type="text" name="amount" class="form-control"
                                                           id="plan-amount"
                                                           value="0" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="login2">Mobile Money Number (MTN)</label>
                                                    <input type="text" name="momo_number" class="form-control"
                                                           placeholder="eg. 0245645344"
                                                           value="{{ old('momo_number') }}"
                                                           required id="momo-number" pattern="^(054|024|055)([0-9]{7,9})"
                                                           oninvalid="this.setCustomValidity('Enter valid mobile money number')"
                                                           oninput="this.setCustomValidity('')" />
                                                </div>
                                                <input type="text" name="plan_id" hidden
                                                       id="selected-subscription-plan">
                                                @php
                                                    $bus = \App\Models\Business::findOrFail(session('business_id'));
                                                @endphp
                                                <p class="text-bold">Hello {{ $bus->name }}, we require you have more
                                                    than <strong>GHC<span id="amount-payable"></span></strong> in your
                                                    Mobile Money
                                                    Wallet.
                                                </p>
                                            </div>
                                            <div class="login-btn-inner mt-2 text-center">
                                                <button class="btn btn-primary btn-block btn-lg" type="submit">Pay
                                                </button>
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
                        <section class="pricing py-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    @php
                                        $subscription = auth()->user()->subscription;
                                    @endphp
                                    @foreach ($plans as $plan)
                                        <div class="col-md-3">
                                            <div class="card mb-5 mb-lg-0">
                                                <div class="card-body">
                                                    <h5 class="card-title text-muted text-uppercase text-center">
                                                        {{ $plan->name }}</h5>
                                                    <h6 class="card-price text-center">GHC {{ $plan->price }}<span
                                                            class="period">/month</span></h6>
                                                    <hr>
                                                    <span class='badge badge-info'>Free 30 day trial</span>
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
                                                               data-price="{{ $plan->price }}" href="#">Subscribe</a>
                                                        @endif
                                                    @else
                                                        @if(is_null($promotionUrl))
                                                            <a class="btn btn-block btn-primary text-uppercase subscribe-plan"
                                                               data-plan=" {{  $plan->id_hash }}" href="#"
                                                               data-price="{{ $plan->price }}">Subscribe</a>
                                                        @else
                                                            <a class="btn btn-block btn-primary text-uppercase"
                                                               href="{{ $promotionUrl . '?plan='. $plan->id_hash }}"
                                                               data-price="{{ $plan->price }}">Subscribe</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            let planId, planPrice;
            $('.subscribe-plan').on('click', function (e) {
                e.preventDefault();

                planId = $(this).data('plan');
                planPrice = $(this).data('price');

                $('#selected-subscription-plan').val(planId);
                $('#plan-amount').val(planPrice);
                $('#amount-payable').text(planPrice);

                $('#zoomInDown1').modal('show');
            });

            $('#renewal_period').on('change', function () {
                let months = $(this).find(':selected').data('months');
                let result = planPrice * months;
                if (result) {
                    $('#plan-amount').val(result);
                    $('#amount-payable').text(result);
                }
            });

            function phonenumber(inputtxt) {
                var phoneno = /^\d{10,12}$/;
                if (inputtxt.value.match(phoneno)) {
                    return true;
                } else {
                    alert("message");
                    return false;
                }
            }
        });
    </script>
@endpush
