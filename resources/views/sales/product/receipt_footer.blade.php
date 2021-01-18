<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <style>
            tr>td {
                border-top: 1px dashed rgb(153, 153, 156);
                border-bottom: 1px dashed rgb(153, 153, 156);
                font-weight: bold;
                margin-top: 5px;
            }
        </style>
    </head>

    <body>
        <table width="100%">
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ now()->format('d/m/Y') }}</td>
                <td>{{ now()->toTimeString('minutes') }}</td>
                <td>{{ @$data->attendant->full_name }}</td>
            </tr>
        </table>

    </body>

</html>
