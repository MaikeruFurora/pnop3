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
    <div class="container mt-4">
        <div class="row">
            <div class="col-1 text-center">
                <img src="{{ asset('image/logo/logo.png') }}" class="" width="110%">
            </div>
            <div class="col-4 my-2">
                <h6 class="mb-0">PILI NATIONAL HIGH SCHOOL</h6>
                <small>Appointment List</small><br>
                <small><b>Date: {{ $dateNow }}</b></small>
            </div>
        </div><br>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Transaction No</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key =>$item)
                <tr>
                    <td>{{  ++$key }}</td>
                    <td>{{  $item->appoint_no }}</td>
                    <td>{{  $item->fullname }}</td>
                    <td>{{  $item->contact_no }}</td>
                    <td>{{  $item->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>