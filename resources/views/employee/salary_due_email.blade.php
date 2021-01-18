<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <title>MTN Business Messenger Salary Due</title>
    </head>

    <body>
        <p>Dear Admin,</p>
        <br>
        <p>Below are the salary due to be paid on {{ today()->toFormattedDateString() }}. </p>
        <br>
        <table class="table table-hover table-response">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Salary Amount (GHS)</th>
                    <th scope="col">Due Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($businesses as $bus)
                    @foreach ($bus->employees as $emp)
                        @if ($emp->salary > 0 && $emp->salary_due_date != null)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $bus->name }}</td>
                                <td>{{ $emp->user->full_name }}</td>
                                <td>{{ $emp->salary }}</td>
                                <td>{{ $emp->salary_due_date->toFormattedDateString() }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>
