<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>MTN Business Messenger - Subscription Expiry Reminder</title>
    </head>

    <body>
        <p>Dear {{ $subscription->user->full_name }},</p>

        <p>This is a reminder of the expiry date of your <strong>{{ $subscription->plan->name }} package. </strong>
            The expiry date of your subscription is
            <strong>{{ $subscription->expiry_date->toFormattedDateString() }}</strong> </p>

            @if($subscription->expiry_date->diffInDays(today()) == 0)
            <p>Kindly renew your subscription to continue using our services</p>
        @else
            <p>Kindly do well to renew your subscription when it expires.</p>
        @endif

        <p>
            Thank,
            {{ config('app.name') }}
        </p>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    </body>

</html>
