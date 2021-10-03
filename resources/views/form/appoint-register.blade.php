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

        .full .ui-state-default {
            color: red;
            border: 1px solid red;
        }

        .vacant .ui-state-default {
            color: green;
            border: .5px solid green;
        }

        .not .ui-state-default {
            color: gray;
            border: 1px solid gray;
        }

        .ui-datepicker-unselectable .ui-state-default {
            background: gray;
            color: black;
            border: none
        }
    </style>
</head>

<body>

    <div id="app">
        <section class="section">
            <div class="container mt-2 center-screen">
                <div class="row">
                    <div class="col-lg">
                        <p style="font-size: 20px;line-height: 2.3;" class="mt-5">Dear user,</p>
                        <p style="font-size: 20px;line-height: 2.3;" class="mt-5">All of the information you provided will be secured and
                            restricted
                            only to Pili National High
                            School Online Portal, school-related businesses and or purposes. We assure your information
                            provided is protected.</p>
                        <p style="font-size: 20px;line-height: 2.3;" class="mt-4">These online services of the school aim to avoid the
                            crowd at the
                            school premises observing
                            the COVID-19 health protocols.</p>
                        <p style="font-size: 20px;line-height: 2.3;" class="mt-4">Thank you</p>
                        <br><br>
                    </div>
                    <div class="col-lg">
                        <form action="{{ route('appoint.save') }}" method="POST">@csrf
                            <div class="card shadow card-info">
                                <div class="card-header">
                                    <h4>Appointment Form</h4>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" name="fullname" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Contact no.</label>
                                            <input type="text" class="form-control" placeholder="Contact no."
                                                name="contact_no" required onkeypress="return numberOnly(event)"
                                                maxlength="11">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Date</label>
                                        <input class="form-control datepicker" name="set_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Purpose</label>
                                        <textarea class="form-control" data-height="80" name="purpose"
                                            required></textarea>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> --}}
    <script src="{{ asset('js/appoint.js') }}"></script>
</body>

</html>