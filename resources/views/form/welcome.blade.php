<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash; Admission</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <style>
        .center-screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* text-align: center; */
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-2 col-lg-10 offset-lg-2 col-xl-8 offset-xl-2 center-screen">
                        {{-- <div class="login-brand">
                                PNHS
                            </div> --}}

                        <div class="card card-primary">
                            <div class="card-body p-5">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-5 text-center">
                                            <img src="{{ asset('image/logo/logo.png') }}" class="">
                                            <p class="mt-4 pb-0 mb-0">PNHS PRE-ENROLLMENT</p>
                                        </div>
                                        <div class="col-lg-7"><br>
                                            <p>Dear Parent/Guardian,<br>

                                                Welcome to our school's pre-enrollment. Please use this form to apply
                                                for
                                                your
                                                child's enroll to our school. We need complete and accurate
                                                information
                                                about the
                                                student, so make sure you fill out all fields. School Pre enrollment
                                                Forms
                                                are
                                                processed

                                            </p>
                                            <a href="{{ route('form') }}"
                                                class="btn btn-lg btn-round btn-primary float-right mt-2">
                                                Proceed
                                            </a>
                                        </div>
                                    </div>
                                </div>

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

</body>

</html>