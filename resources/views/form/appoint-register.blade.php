<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash;</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <style>
        .center-screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* text-align: center; */
            min-height: 90vh;
        }

        .blue-highlight {
            background-color: #0C91FF !important;
            color: white !important;
        }

        .blue-highlight:hover {
            background-color: #0A70FF !important;
        }

        .red-highlight {
            background-color: #FF3205 !important;
            color: white !important;
        }

        .red-highlight:hover {
            background-color: #FF0800 !important;
        }
    </style>

</head>

<body>

    <div id="app">
        <section class="section">
            <div class="container mt-2 center-screen">
                <div class="row">
                    <div class="col-lg">
                        <p style="font-size: 20px" class="mt-5">Dear user,</p>
                        <p style="font-size: 20px" class="mt-5">All of the information you provided will be secure and
                            restricted
                            only to Pili National High
                            School Online Portal, school-related businesses and or purposes. We assure your information
                            provided is protected.</p>
                        <p style="font-size: 20px" class="mt-4">These online services of the school aim to avoid the
                            crowd at the
                            school premises observing
                            the COVID-19 health protocols.</p>
                        <p style="font-size: 20px" class="mt-4">Thank you</p>
                    </div>
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <h4>Appointment Form</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Contact no.</label>
                                        <input type="text" class="form-control" placeholder="Contact no.">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Select Date</label>
                                    <input class="form-control datepicker">
                                </div>
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <textarea class="form-control" data-height="80"></textarea>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <!-- General JS Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <style>
        .full .ui-state-default {
            color: red;
            border: 1px solid red;
        }

        .vacant .ui-state-default {
            color: green;
            border: 1px solid green;
        }
    </style>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('.datepicker').datepicker({
            dateFormat: "mm/dd/yy",
            minDate:0,
            // beforeShowDay : function (date) {
            //       var dayOfWeek = date.getDay ();
            //       // 0 : Sunday, 1 : Monday, ...
            //       return dayOfWeek == 0 || dayOfWeek == 6? [false]: [true];
                
            //    },
            beforeShowDay : function (date) {
                let datew=$.datepicker.formatDate("mm/dd/yy",date);
                console.log(datew);
                return[true,datew=='09/23/2021'?'full':'vacant'];
                
               }
        });
    </script>
</body>

</html>