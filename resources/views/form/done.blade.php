<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash; Pre-enrollment</title>

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
              <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2 mt-5">
                {{-- <div class="login-brand">
                  <img src="{{ asset('image/logo/logo.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                  <h3 class="mt-3">Online Pre-Enrollment was successful</h3>
                </div> --}}
    
                <div class="card card-hero">
                  <div class="card-header pb-3">
                    <div class="card-icon">
                        <i class="far fa-question-circle"></i>
                      </div>
                      <h4>{{ $data }}</h4>
                      <div class="card-description">ENROLLMENT NO.</div>
                      <small class="mb-0" style="font-size:12px">* Please save the enrollment no. for your inquries</small>
                  </div>
    
                  <div class="card-body">
                    
                    <div class="tickets-list">
                        <a href="#" class="ticket-item">
                          <div class="ticket-title">
                            <div class="login-brand">
                                <img src="{{ asset('image/logo/logo.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                                <h4 class="mt-3">Online Pre-Enrollment was successful</h4>
                                <small>{{ date("Y-m-d") }}</small>
                              </div>
                          </div>
                        </a>
                        <a href="#" class="ticket-item">
                          <div class="ticket-title">
                            <h4>School Contact & Information</h4>
                          </div>
                          <div class="ticket-info">
                            <div><i class="fa fa-address-book"></i> 09918742564</div>
                            <div class="bullet"></div>
                            <div><i class="fa fa-at"></i> 302016@deped.gov.ph</div>
                            <div class="bullet"></div>
                            <div><i class="fa fa-map-marker-alt"></i> Zone 2, Lapaz Pawili, Pili Camarines Sur</div>
                          </div>
                        </a>
                      
                    </div>
                </div>
                <a href="{{ route('done.download',$data) }}" class="ticket-item ticket-more btn btn-icon icon-left btn-primary btn-block p-3">
                    <i class="fas fa-download"></i> Download Form
                </a>
                </div>
                <div class="simple-footer">
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