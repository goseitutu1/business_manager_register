@extends('auth.layout')

@section('errors')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endsection

@section('content')
<form class="panel__body" method="POST" action="{{ route('password.update') }}">
    @csrf
    <div class="sign text-center">
        <p class="sign__input" style="margin-top: -2em">Password Reset</p>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="Enter Email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter New Password" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                placeholder="Confirm Password" required autocomplete="new-password">
        </div>

        <div class="option">
            <div class="option__item">
                <button type="submit" class="button">{{ __('Reset Password') }}</button>
            </div>
        </div>

    </div>
</form>
@endsection
