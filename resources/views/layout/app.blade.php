<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &middot; PNHS Online Portal</title>
    <link rel="shortcut icon" href="{{ asset('image/logo/logo1.png') }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- CSS Libraries -->
    @yield('moreCss')
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('../layout/navbar')
            @include('../layout/main-sidebar')
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            @include('../layout/footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>
    <script src="{{ asset('js/toast/iziToast.min.js') }}"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    @yield('moreJs')
    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>