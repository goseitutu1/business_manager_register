@extends('UI_new.email')
@section('content')
<h1>Hello, {{ $admin->user->full_name }}</h1>

<p>New account has been created for you with the role <b>{{ $admin->role->name }}</b>.</p>
<p> Kindly login to your account with the information below:</p>
<p>
 <strong>Email:</strong> {{ $admin->user->email }}<br>
 <strong>Password:</strong> {{ $password }}
</p>
<p>Kindly login to your account.</p>

<!-- Action -->
<table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <!-- Border based button
           https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                    <td align="center">
                        <a href="{{ route('login') }}" class="f-fallback button" target="_blank">Login</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@endsection
