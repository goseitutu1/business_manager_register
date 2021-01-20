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

</head>

<body style="font-family: 'MTNBrighterSans-Regular' !important; overflow: scroll">
<!-- partial:index.partial.html -->
<main class="login">
    <!-- Carousel -->
    <section class="login__left">
        <div id="loginCarousel" class="carousel slide" data-ride="carousel" data-interval="50000"
             data-pause="hover">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#loginCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#loginCarousel" data-slide-to="1"></li>
                <li data-target="#loginCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="background-overlay"></div>
                    <div class="slide"
                         style="background-image:url({{asset('UI/images/backgrounds/s4.jpg')}});background-size:cover;">
                    </div>
                    <div class="carousel-caption">
                        <h1 class="slide__title" style="font-size: 2.6em !important;">MTN Business Manager Lite
                        </h1>
                        <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">Our
                            new innovation for SME's</p>
                        <!--            <a href="#" class="slide__button">Read More</a>-->
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="background-overlay"></div>
                    <div class="slide"
                         style="background-image:url({{asset('UI/images/backgrounds/s7.jpg')}});background-size:cover;">
                    </div>
                    <div class="carousel-caption">
                        <h1 class="slide__title" style="font-size: 2.6em !important;">MTN Business Manager Lite
                        </h1>
                        <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">All
                            your businesses managed by one app </p>
                        <!--            <a href="#" class="slide__button">Read More</a>-->
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="background-overlay"></div>
                    <div class="slide"
                         style="background-image:url({{asset('UI/images/backgrounds/s8.jpg')}});background-size:cover;">
                    </div>
                    <div class="carousel-caption">
                        <h1 class="slide__title" style="font-size: 2.6em !important;">MTN Business Manager Lite
                        </h1>
                        <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">Tell
                            a friend about MTN Business Manager today</p>
                        <!--            <a href="#" class="slide__button">Read More</a>-->
                    </div>
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#loginCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#loginCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
@include('auth.terms_and_conditions_modal')
<!-- Login -->
    <section class="login__right">
        <div class="panel">
            <article class="panel__header">
                <div class="header__brand">
                    <a class="header__logo" href="#">
                        <svg id="brand" width="28" height="28" viewBox="0 0 24 24"></svg>
                        <img src="{{asset('UI/images/backgrounds/MTN.png')}}" style="width: 3em"></a>
                    <h5 class="header__text">MTN Business Manager Lite</h5>
                </div>
            </article>

            @section('content')
                <form class="panel__body" action="{{ route('register') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="sign text-center">
                        <p class="sign__input" style="margin-top: -4em">Create Accounts</p>
                        @if($errors)
                            @foreach ($errors->all() as $message)
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <label for="first_name" class="" style="float: left">First name <strong
                                    style="color:red">*</strong></label>
                            <input type="first_name" class="form-control" name="first_name" id="first_name"
                                   placeholder="Enter First Name (mandatory)"
                                   value="{{ old('first_name',$tmp_user->first_name ?? null) }}" required>
                            <input type="hidden" name="tmp_id" value="{{$tmp_user->id ?? null}}">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="" style="float: left">Last name <strong
                                    style="color:red">*</strong></label>
                            <input type="last_name" class="form-control" name="last_name" id="last_name"
                                   placeholder="Enter Last Name (mandatory)"
                                   value="{{ old('last_name',$tmp_user->last_name ?? null) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="" style="float: left">Email <strong
                                    style="color:red">*</strong></label>
                            <input type="email" class="form-control" name="email" id="email"
                                   placeholder="Enter Business Email (mandatory)" value="{{ old('email') }}" autocomplete="email"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="" style="float: left">Phone Number <strong
                                    style="color:red">*</strong></label>
                            <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                   placeholder="Enter Phone Number (mandatory)"
                                   value="{{ old('phone_number',$tmp_user->phone_number ?? null) }}" required>
                        </div>




                        <div class="form-group" id="advert_source_div">
                            <label for="advert_source_val" class="" style="float: left">Please specify <strong
                                    style="color:red">*</strong></label>
                            <textarea type="text" class="form-control" name="advert_source_val"
                                      id="advert_source_val">{{ old('advert_source_val') }}</textarea>
                        </div>

                        <label for="password" class="" style="float: left">Password <strong style="color:red">*</strong></label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control password" name="password" id="password"
                                   value="{{ old('password') }}" placeholder="Enter Password " required
                                   autocomplete="password">
                            <div class="input-group-append">
                                <button class="btn btn-primary view-password" type="button"><i
                                        class="fa fa-eye"></i></button>
                            </div>
                        </div>

                            <label for="confirm_password" class="" style="float: left">Confirm password<strong style="color:red">*</strong></label>
                            <div class="input-group">
                                <input type="password" class="form-control password" name="confirmed"
                                    id="confirm_password" value="{{ old('confirmed') }}" placeholder="Confirm Password"
                                    required autocomplete="password">
                                <div class="input-group-append">
                                    <button class="btn btn-primary view-password" type="button"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>

                    <div class="form-group">
                        <label for="advert_source" class="" style="float: left">How did you hear about this product
                            ? <strong style="color:red">*</strong></label>
                        <select class="form-control" id="advert_source" name="advert_source" required>
{{--                            <option></option>--}}
                            <option value="Sales Agent">Sales Agent</option>
{{--                            <option value="Advert">Advert</option>--}}
{{--                            <option value="Family/Friend">Family/Friend</option>--}}
{{--                            <option value="Other">Other (Please specify)</option>--}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email" class="" style="float: left">Agent Name <strong style="color:red">*</strong></label>
                        <input type="text" class="form-control" name="agent" id="agent" placeholder="Agents Full Name" value="{{ old('agent') }}" autocomplete="agent" required>
                    </div>

                        <div class="form-group mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="true" id="invalidCheck"
                                       required name="terms_and_conditions">
                                <a class="mt-3" href="#" for="invalidCheck" data-toggle="modal"
                                   data-target="#termsAndConditionsModal">
                                    Agree to Terms and Conditions
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="option">
                        <div class="option__item">
                            <button type="submit" class="button">Register</button>
                        </div>
                        {{-- <div class="option__item">
                            <button type="submit" class="button">Log out</button>
                        </div> --}}
{{--                        <div class="option__item">--}}
{{--                            <a href="{{ route('login') }}" class="link-text">Have an account? Login</a>--}}
{{--                        </div>--}}
                    </div>
                </form>
            @show

            <img src="{{asset('UI/images/backgrounds/NpontuLogostroke.png')}}" style="width:7em">
            <article class="panel__footer">
                <p class="small"><a href="https://npontu.com">©
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script>
                        Npontu Technologies</a></p>
                <ul class="list-unstyle list-inline">
                    <li class="list-inline-item small">
                        {{-- <a href="#">Privacy Policy</a> --}}
                        <a class="mt-3" href="#" data-toggle="modal"
                           data-target="#privacyPolicyModal">Privacy Policy
                        </a>
                    </li>
                    <li class="list-inline-item small"><a href="#" data-toggle="modal" data-target="#termsAndConditionsModal">Terms</a></li>
                </ul>

            </article>
        </div>
    </section>
</main>
<!-- partial -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src="{{ asset('js/customer.js') }}"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $('.carousel').carousel({interval: 7000});
        const advert_div = $('#advert_source_div'),
            advert_source_val = $('#advert_source_val');
        advert_div.hide();


        $('#advert_source').on('change', function () {
            let value = $(this).val();
            console.log(value);
            if (value === 'Other') {
                advert_div.show()
                advert_source_val.prop('required', true)
            } else {
                advert_div.hide();
                advert_source_val.val("");
                advert_source_val.prop('required', false)
            }
        })

        $(".view-password").on('click', function () {
            {{-- $(".password").attr('type', 'text'); --}}
            $(".password").attr('type', function (index, currentvalue) {
                if (currentvalue == "password") return "text";
                return "password";
            })
        });

        $("#logo").change(function () {
            filePreview(this, $("#logo-preview"));
        });
    });
</script>
</body>

</html>
