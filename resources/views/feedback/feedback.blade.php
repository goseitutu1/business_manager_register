@component('mail::message')
# CLIENT NAME : {{$business_name->name}}
<br>
## SUBJECT
{{ $subject }}

## MESSAGE
{{ $message }}
{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
