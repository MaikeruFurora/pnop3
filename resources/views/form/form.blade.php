<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PNOP &mdash; Admission</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> --}}

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/toast/iziToast.min.css') }}">
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
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title lead" id="staticBackdropLabel">Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 class="txt"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="container mt-5">
                <form id="enrollForm">@csrf
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 col-lg-12 offset-lg-0 center-screen">
                            <div class="card card-primary">
                                <div class="row m-0">
                                    <div class="col-12 col-md-12 col-lg-4 p-0">
                                        <div class="card-header text-center">
                                            <h4>Enrollment Form</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group floating-addon">
                                                <label>LRN (Learner Reference Number)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="far fa-id-card"></i>
                                                        </div>
                                                    </div>
                                                    <input name="roll_no" type="text" class="form-control" autofocus
                                                        pattern="^[0-9]{12}$" onkeypress="return numberOnly(event)"
                                                        maxlength="12" required>
                                                </div>
                                            </div>

                                            <div class="form-group floating-addon">
                                                <label>Status</label>
                                                <select name="status" class="form-control" id="">
                                                    <option value="new">Incoming grade 7</option>
                                                    <option value="transferee">Transferee</option>
                                                </select>
                                            </div>
                                            <div class="form-group floating-addon">
                                                <label>Grade level to Enroll</label>
                                                <select name="grade_level" class="form-control" id="">
                                                    <option></option>
                                                    <option value="8">Grade 8</option>
                                                    <option value="9">Grade 9</option>
                                                    <option value="10">Grade 10</option>
                                                </select>
                                            </div>
                                            <div class="form-group floating-addon">
                                                <label>Curriculum</label>
                                                <select name="curriculum" class="form-control" required>
                                                    <option value=""></option>
                                                    <option value="STEM">STEM - Science Technology Engineering and
                                                        Mathematics</option>
                                                    <option value="BEC">BEC - Basic Education Curriculum</option>
                                                    <option value="SPA">SPA - Special Program Art</option>
                                                    <option value="SPJ">SPJ - Special Program Journalism</option>
                                                </select>
                                            </div>
                                            <div class="form-group floating-addon">
                                                <label>Last school attended</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-graduation-cap" style="font-size: 13px"></i>
                                                        </div>
                                                    </div>
                                                    <input id="last_school_attended" type="text" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-8 p-0">

                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-4">
                                                        <label>First name</label>
                                                        <input name="student_firstname" type="text" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Middle name</label>
                                                        <input name="student_middlename" type="text"
                                                            class="form-control">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Last name</label>
                                                        <input name="student_lastname" type="text" class="form-control"
                                                            placeholder="Last name, (extn)" required>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-lg-4">
                                                        <label>Date of Birth</label>
                                                        <input type="date" class="form-control" required
                                                            name="date_of_birth">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control" id="">
                                                            <option value=""></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Your Contact No.</label>
                                                        <input type="text" class="form-control" name="student_contact"
                                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)"
                                                            maxlength="11">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label>Region</label>
                                                        <select name="region_text" id="region" class="custom-select">
                                                            {{-- <option value="region"></option> --}}
                                                        </select>
                                                        <input type="hidden" name="region" id="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Province</label>
                                                        <select name="province_text" id="province"
                                                            class="custom-select">
                                                            {{-- <option value="province"></option> --}}
                                                        </select>
                                                        <input type="hidden" name="province" id="">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Town</label>
                                                        <select name="city_text" id="city" class="custom-select">
                                                            {{-- <option value="city"></option> --}}

                                                            <input type="hidden" name="city" id="">
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Barangay</label>
                                                        <select name="barangay_text" id="barangay"
                                                            class="custom-select">
                                                            {{-- <option value="barangay"></option> --}}
                                                        </select>
                                                        <input type="hidden" name="barangay" id="">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Father's name</label>
                                                        <input type="text" class="form-control" name="father_name">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Contact No.</label>
                                                        <input type="text" class="form-control" name="father_contact_no"
                                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)"
                                                            maxlength="11">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Mother's name</label>
                                                        <input type="text" class="form-control" name="mother_name">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Contact No.</label>
                                                        <input type="text" class="form-control" name="mother_contact_no"
                                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)"
                                                            maxlength="11">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-8">
                                                        <label>Guardian's name</label>
                                                        <input type="text" class="form-control" name="guardian_name">
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>Contact No.</label>
                                                        <input type="text" class="form-control"
                                                            name="guardian_contact_no" pattern="^[0-9]{11}$"
                                                            onkeypress="return numberOnly(event)" maxlength="11">
                                                    </div>

                                                </div>

                                                <div class="form-group text-right mb-0">
                                                    <button type="submit"
                                                        class="btn btn-round btn-lg btn-primary btnEnroll">
                                                        Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('js/toast/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>

    <!-- Page Specific JS File -->
    <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js">
    </script>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>