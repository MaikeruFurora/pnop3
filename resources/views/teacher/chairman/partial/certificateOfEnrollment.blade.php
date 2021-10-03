<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background: white">
    <div class="container">
       
        </div>

        <table style="width: 100%">
            <tr>
                <td class="text-right"> <img src="{{ asset('image/logo/logo.png') }}" alt="" width="130px"></td>
                <td class="text-center">
                    <p style="line-height: 0.5;font-size: 23px;font-family:'times new roman'" class="mt-3">Republic of the Philippines</p>
                    <p style="line-height: 0.5;font-size: 23px;font-family:'times new roman'">Department of Education</p>
                    <p style="line-height: 0.5;font-size: 23px;font-family:'times new roman'">Region V</p>
                    <p style="line-height: 0.1;font-size: 23px;font-family:'times new roman'">Division of Camarines Sur</p>
                    <h4 style="font-family:'times new roman'">PILI NATIONAL HIGH SCHOOL</h4>
                    <p style="line-height: 0.5;font-size: 23px;font-family:'times new roman'">Lapaz Pawili, Pili Camarines Sur</p>
                </td>
                <td class="text-left"> <img src="{{ asset('image/logo/deped.png') }}" alt="" width="190px"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding-left:15%;padding-right:15%">
                    <p style="line-height:2;font-family:'times new roman';font-size:25px;margin-top:7%">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <span style="font-size:25px"><em><b>{{ $fullname}}</b></em></span> is officially enrolled as {{ $student_type }} 
                        Grade {{ $grade_level }} with Learner Reference Number <b>{{ $roll_no }}</b> in this institution this School Year {{ $school_year }}.
                    </p><br>
                    <p style="line-height:2;font-family:'times new roman';font-size:25px">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This CERTIFICATION is issued upon the request of the aforenmentioned name 
                        for whatever legal purposes that mau serve him/her under the law.
                    </p><br>
                    <p style="line-height:2;font-family:'times new roman';font-size:25px">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Given this {{ date("j") }} <sup>{{ date("S") }}</sup> day of {{ date("F, Y") }} at Pili National High School,
                        Pawili, Pili Camarines Sur.
                    </p>
                </td>
            </tr>
            <tr>
                <td class="float-right">
                    <p class="text-center" style="margin-top:50%;font-size:26px;font-family:'times new roman'">
                        Not Valid <br> Without School <br> Official Seal
                    </p>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="float-left">
                    <p class="text-center" style="margin-top:50%;font-size:26px;font-family:'times new roman'">
                        {{ strtoupper($teacher) }} <br>Teacher in-Charge
                    </p>
                </td>
            </tr>
        </table>
</body>
</html>