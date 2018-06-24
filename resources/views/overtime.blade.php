<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Overtime Calculator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Daily Over time</th>
                        <th>Weekly Over time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->firstName.' '.$user->lastName }}</td>
                        <td align="center">{{ $user->getDailyOvertimeHour() }}</td>
                        <td align="center">{{ $user->getWeeklyOvertimeHour() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</html>


<script>
$(document).ready(function () {
    $('#example').DataTable();
});

</script>