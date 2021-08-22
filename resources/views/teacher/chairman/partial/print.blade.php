<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PRINT REPORT</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body style="background: white">
    <div class="container">
        <div class="row">
            <div class="col-1 text-center">
                <img src="{{ asset('image/logo/logo.png') }}" class="" width="120%">
            </div>
            <div class="col-4 my-3">
                <h6 class="mb-0">PILI NATIONAL HIGH SCHOOL</h6>
                <small>List of student</small>
            </div>
        </div><br>
        <p class="mb-0">Section: {{ $section }}</p>
        <small>Total Student: {{ $total->mtotal+$total->ftotal }}</small>&nbsp;&nbsp;
        <small>Male: {{ $total->mtotal }}</small>&nbsp;&nbsp;
        <small>Female: {{ $total->ftotal }}</small>
        <table class="table table-bordered table-sm mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataNow as $key =>$student)
                <tr>
                    <td>{{  ++$key }}</td>
                    <td>{{  $student->fullname }}</td>
                    <td>{{  $student->gender }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>