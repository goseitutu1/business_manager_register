<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>MTN Business Manager Lite</title>
    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="description" content="Our new innovation for SME's">

<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="{{asset('UI/css/style.css')}}">

  <style>
    @font-face {
      font-family: "MTNBrighterSans-Regular";
      src: url({{asset('UI/fonts/MTNBrighterSans-Regular.ttf')}});
    }
  </style>
</head>
<body style="font-family: 'MTNBrighterSans-Regular' !important;">
<!-- partial:index.partial.html -->
<main class="login">
  <!-- Carousel -->
  <section class="login__left">
    <div id="loginCarousel" class="carousel slide" data-ride="carousel" data-interval="50000" data-pause="hover">
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
          <div class="slide" style="background-image:url({{asset('UI/images/backgrounds/s4.jpg')}});background-size:cover;"> </div>
          <div class="carousel-caption">
            <h1 class="slide__title" style="font-size: 2.6em !important;">MTN Business Manager Lite</h1>
            <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">Our new innovation for SME's</p>
<!--            <a href="#" class="slide__button">Read More</a>-->
          </div>
        </div>
        <div class="carousel-item">
          <div class="background-overlay"></div>
          <div class="slide" style="background-image:url({{asset('UI/images/backgrounds/s7.jpg')}});background-size:cover;"></div>
          <div class="carousel-caption">
            <h1 class="slide__title"  style="font-size: 2.6em !important;">MTN Business Manager Lite</h1>
            <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">All your businesses managed by one app </p>
<!--            <a href="#" class="slide__button">Read More</a>-->
          </div>
        </div>

        <div class="carousel-item">
          <div class="background-overlay"></div>
          <div class="slide" style="background-image:url({{asset('UI/images/backgrounds/s8.jpg')}});background-size:cover;"></div>
          <div class="carousel-caption">
            <h1 class="slide__title"  style="font-size: 2.6em !important;">MTN Business Manager Lite</h1>
            <p class="slide__text" style="font-size: 1em !important; color:#ffc423 !important;">Tell a friend about MTN Business Manager today</p>
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
  <!-- Login -->
  <section class="login__right">
    <div class="panel">
      <article class="panel__header">
        <div class="header__brand">
          <a class="header__logo" href="#">
          <svg id="brand"  width="28" height="28" viewBox="0 0 24 24">
            <img src="{{asset('UI/images/backgrounds/MTN.png')}}" style="width: 3em"></a>
          <h5 class="header__text">MTN Business Manager Lite</h5>
        </div>
      </article>

      <form class="panel__body" action="{{ route('login') }}" method="POST" id="loginForm">
          @csrf
        <div class="sign text-center">
          <p class="sign__input" style="margin-top: -2em">Sign in to continue</p>
            @if($errors)
                @foreach ($errors->all() as $message)
                    <div class="alert alert-danger" role="alert">
                        {{$message}}
                    </div>
                @endforeach
            @endif
          <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Enter your password">
          </div>
        </div>

        <div class="option">
          <div class="option__item">
            <button type="submit" class="button">Sign In</button>
          </div>
          <div class="option__item">
            <a href="#" class="link-text">Forgot password?</a>
          </div>
        </div>
        <div class="account text-center">
          <p>Don't have an account?</p>
          <a href="#" class="link-text">Create account</a>
        </div>
      </form>
      <img src="{{asset('UI/images/backgrounds/NpontuLogostroke.png')}}" style="width:7em">
      <article class="panel__footer">
        <p class="small"><a href="https://npontu.com">©<script type="text/javascript">document.write(new Date().getFullYear());</script> Npontu Technologies</a></p>
        <ul class="list-unstyle list-inline">
          <li class="list-inline-item small"><a href="#">Privacy Policy</a></li>
          <li class="list-inline-item small"><a href="#">Terms</a></li>
        </ul>

      </article>
    </div>
  </section>
</main>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $('.carousel').carousel({interval: 7000});


  });
</script>
</body>
</html>
