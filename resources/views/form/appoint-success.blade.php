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
            border: 1px solid green;
        }

        .not .ui-state-default {
            color: gray;
            border: 1px solid gray;
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                    
                        <div id="capture">

                            <div class="card card-hero shadow-lg">
                                <div class="card-header">
                                  <div class="card-icon">
                                    <i class="fas fa-fingerprint"></i>
                                  </div>
                                  <h4><small style="font-size: 15px">No.</small> {{$appointment->appoint_no }}</h4>
                                  <div class="card-description">Appointment Slip</div>
                                </div>
                                <div class="card-body p-0">

                                    <ul class="list-unstyled list-unstyled-border p-4">
                                        <li class="media">
                                            <a href="#">
                                                {{-- <img class=" width=" 50" src="{{ asset('image/avatar-1.png') }}" alt="product">
                                                --}}
                                                <i class="mr-3 rounded fas fa-user mr-4 my-2" style="font-size: 23px"></i>
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right my-2" style="font-size: 25px">
                                                  
                                                </div>
                                                <div class="media-title">{{$appointment->fullname }}</div>
                                                <div class="text-muted text-small">Fullname</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <a href="#">
                                                <i class="mr-3 rounded fas fa-location-arrow mr-4 my-2" style="font-size: 23px"></i>
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right my-2" style="font-size: 25px"></div>
                                                <div class="media-title">{{$appointment->address }}</div>
                                                <div class="text-muted text-small">Address
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <a href="#">
                                                <i class="mr-3 rounded fas fa-calendar mr-4 my-2" style="font-size: 23px"></i>
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right my-2" style="font-size: 25px"></div>
                                                <div class="media-title">{{$appointment->set_date }}</div>
                                                <div class="text-muted text-small">Date
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <a href="#">
                                                <i class="mr-3 rounded fas fa-star mr-4 my-2" style="font-size: 23px"></i>
                                            </a>
                                            <div class="media-body">
                                                <div class="media-right my-2" style="font-size: 25px"></div>
                                                <div class="media-title">{{$appointment->purpose }}</div>
                                                <div class="text-muted text-small">Purpose
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                           
                                            <div class="media-body">
                                                <div class="media-right my-2 pl-3 pr-2">
                                                    <img class="img-fluid m-0" src="{{ asset('image/logo/logo.png') }}"
                                                    alt="PNHS LOGO" width="50px">
                                                </div>
                                                <div class="text-small">
                                                    <b>Note:</b> This will serve will serve as a proof of transaction and or appointment, 
                                                    present this to the personnel in charge upon entering the school the day of your appointment. Thank you!
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                  <div class="tickets-list">
                                   
                                    <button id="btn" class="ticket-item ticket-more btn btn-icon icon-left btn-primary">
                                        <i class="fas fa-download"></i> Download Image
                                    </button>
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
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> --}}
    {{-- <script src="{{ asset('js/appoint.js') }}"></script> --}}
    <script src="{{ asset('js/html2canvas/html2canvas.js') }}"></script>
    <script>
    $("#btn").on('click',function(){
        $(".card-hero").removeClass('shadow-lg')
        $(this).hide();
      setTimeout(() => {
        $(".card-body").addClass("bg-white")
        html2canvas(document.getElementById("capture")).then(function (canvas) {
      //  console.log(canvas.toDataURL("image/jpeg", 0.9));
        var a=document.createElement('a');
                a.href = canvas.toDataURL("image/png");
                a.download = "appointment-slip.png";
                a.click();
     });
     $(".card-hero").addClass('shadow-lg')
     $(this).show();   
      }, 1500);
    })
    </script>
</body>

</html>