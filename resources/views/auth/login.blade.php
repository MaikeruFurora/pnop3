<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash; Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> --}}

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
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 center-screen">
                        {{-- <div class="login-brand">
                            <img src="/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div> --}}
                        @if (session()->has('msg'))
                        <div class="alert alert-warning text-center" role="alert">
                            {{ session('msg') }}
                        </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header pt-1 pb-0">
                                <div class="col-12">
                                    <div class="row mt-0 mb-0 justify-content-between">
                                        <div class="py-2">
                                            <h4>Login</h4>
                                        </div>
                                        <div class=" float-right">
                                            <img class="img-fluid m-0 p-0" src="{{ asset('image/logo/logo.png') }}"
                                                alt="PNHS LOGO" width="50px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-1">
                                <form method="POST" action="{{ route('auth.login_post') }}" class="needs-validation"
                                    novalidate="">@csrf
                                    <div class="form-group">
                                        <label for="get_your_input">Username | ID No.</label>
                                        <input id="get_your_input" type="text" class="form-control"
                                            name="get_your_input" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill this field [username or ID No.]
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            {{-- <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div> --}}
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2" required>
                                        <div class="invalid-feedback">
                                            Please fill in your password
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="user_type">Login as</label>
                                        <select name="user_type" class="form-control">
                                            <option value="Student">Student</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Administrator">Administrator</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer mt-0">
                            Copyright &copy; Stisla 2018
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

    <!-- Page Specific JS File -->
</body>

</html>