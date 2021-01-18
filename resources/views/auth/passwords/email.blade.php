@extends('auth.layout')

@section('errors')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
@endsection

@section('content')
<form class="panel__body" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="sign text-center">
        <p class="sign__input" style="margin-top: -2em">Password Reset</p>
        <div class="form-group col-md-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="option">
            <div class="option__item">
                <button type="submit" class="button">{{ __('Send Password Reset Link') }}</button>
            </div>
        </div>
        <div class="account text-center">
            <p>Remembered Password?</p>
            <a href="{{ route('login') }}" class="link-text">Login</a>
        </div>
    </div>
</form>
@endsection
