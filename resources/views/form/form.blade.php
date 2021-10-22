
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Online Pre-Enrollment</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('css/selectric.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
  <div id="app">

      <section class="section">
          <div class="container mt-5">
              <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                {{-- <img src="{{ asset('image/requirements/163427306253077945_grade.png') }}" alt=""> --}}
              <img src="{{ asset('image/logo/logo.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
              <p class="mt-2">PILI NATIONAL HIGH SCHOOL</p>
              <h6 style="margin-top: -8px">ONLINE PRE-ENROLLMENT</h6>
            </div>

            <div class="card card-primary shadow">
              <div class="card-header pb-0 pt-0 text-primary">
                  <h6>Enrollment Form</h6>
              </div>

              <div class="card-body pt-0">
                  <p style="font-size: 12px" class="mb-4">* Please put N/A if not Applicable</p>
                  <form id="enrollForm" autocomplete="off">@csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="frist_name" type="text" class="form-control" name="student_firstname" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Middle Name</label>
                      <input id="last_name" type="text" class="form-control" name="student_middlename">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="student_lastname" required>
                      </div>
                      <div class="form-group col-6">
                        <label>Extension Name</label>
                        <input type="text" class="form-control">
                      </div>
                  </div>

                  {{-- end of name --}}

                  <div class="row">
                    <div class="form-group col-4">
                      <label for="frist_name">Learning Reference Number (LRN)</label>
                      <input name="roll_no" type="text" class="form-control" onkeypress="return numberOnly(event)" maxlength="12" required>
                    </div>
                    <div class="form-group col-4">
                        <label>Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="new">Incoming grade 7</option>
                            <option value="new_eleven">Incoming grade 11</option>
                            <option value="transferee">Transferee</option>
                            <option value="balikAral">Balik Aral</option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>Grade level to Enroll</label>
                        <select name="grade_level" class="form-control" id="">
                            <option></option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>
                      </div>
                  </div>
                
                  {{-- status enroll --}}


                  {{-- FOR ADDITIONAL FOR INFO FOR BALIK ARAL --}}

                    <div class="form-group" id="forBalik">
                        <label>Last school year attended (Balik-Aral)</label>
                        <input name="last_schoolyear_attended" type="text" class="form-control"
                            placeholder="eg. 2018-2019">
                    </div>

                    <div class="row">
                        <div class="form-group col-4" id="forcurriculum">
                            <label>Curriculum</label>
                            <select name="curriculum" class="form-control">
                                <option value=""></option>
                                <option value="STEM">STEM - Science Technology Engineering and
                                    Mathematics</option>
                                <option value="BEC">BEC - Basic Education Curriculum</option>
                                <option value="SPA">SPA - Special Program Art</option>
                                <option value="SPJ">SPJ - Special Program Journalism</option>
                            </select>
                        </div>
                        <div class="form-group col-4" id="forStrand">
                            <label>Strand & Specialization</label>
                            <select name="strand" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-8">
                            <label>Last school attended</label>
                            <input name="last_school_attended" type="text" class="form-control" required>
                        </div>
                    </div>


                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true"><i class=" fas fa-user-check"></i> Personal Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false"><i class=" fas fa-users"></i> Family Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact" aria-selected="false"><i class=" fas fa-cloud-upload-alt"></i> Upload Requirements</a>
                    </li>
                  </ul>

                  <div class="tab-content tab-bordered shadow" id="myTab3Content">
                    <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                            {{-- tab one --}}
                              {{-- personal information --}}
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" required
                                            name="date_of_birth">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" id="" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Student Contact No.</label>
                                        <input type="text" class="form-control" name="student_contact"
                                            onkeypress="return numberOnly(event)" maxlength="11">
                                    </div>
                                </div>
                                {{-- end personalinformation --}}
                                {{-- address --}}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Region</label>
                                        <select name="region_text" id="region" class="custom-select"
                                            required>
                                            {{-- <option value="region"></option> --}}
                                        </select>
                                        <input type="hidden" name="region" id="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Province</label>
                                        <select name="province_text" id="province" class="custom-select"
                                            required>
                                            {{-- <option value="province"></option> --}}
                                        </select>
                                        <input type="hidden" name="province" id="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Municipality</label>
                                        <select name="city_text" id="city" class="custom-select"
                                            required>
                                            {{-- <option value="city"></option> --}}

                                            <input type="hidden" name="city" id="">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Barangay</label>
                                        <select name="barangay_text" id="barangay" class="custom-select"
                                            required>
                                            {{-- <option value="barangay"></option> --}}
                                        </select>
                                        <input type="hidden" name="barangay" id="">
                                    </div>
                                </div>
                                {{-- address end --}}
                            {{-- tab oen end --}}
                    </div>
                    <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                        {{-- tab two --}}
                        <div class="form-row">
                            <div class="form-group col-lg-8">
                                <label>Father's Name <em><small>(Last Name, First Name Middle Name)</small></em></label>
                                <input type="text" class="form-control" name="father_name">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="father_contact_no"
                                    onkeypress="return numberOnly(event)" maxlength="11">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-8">
                                <label>Mother's Name <em><small>(Last Name, First Name Middle Name)</small></em></label>
                                <input type="text" class="form-control" name="mother_name">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="mother_contact_no"
                                    onkeypress="return numberOnly(event)" maxlength="11">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-8">
                                <label>Guardian's Name <em><small>(Last Name, First Name Middle Name)</small></em></label>
                                <input type="text" class="form-control" name="guardian_name">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control"
                                    name="guardian_contact_no"
                                    onkeypress="return numberOnly(event)" maxlength="11">
                            </div>

                        </div>
                        {{-- tab two --}}
                    </div>
                    <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
                        {{-- tab three --}}
                            <small>* <b>Note:</b> Upload requirement are optional, Once you've registered, the office will be notified, 
                                and they'll double-check your information. Before students are sectioned, the office will notify you that 
                                you must submit all physical copies of your requirements.</small>
                                <small><b>File format: ( png,jpeg,jpg )</b></small>
                            <div class="form-group mt-2">
                                <label for="">Latest Copy of Grades</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="req_grade">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Good Moral Certificate</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="req_goodmoral">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">PSA Birth Certificate</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="req_psa">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        {{-- tab three --}}
                    </div>
                  </div>
               
                  <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-lg btn-block btnEnroll">
                      Register
                    </button>
                  </div>
                </form>
              </div>
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
   <script src="{{ asset('js/popper.min.js') }}"></script>
   <script src="{{ asset('js/tooltip.js') }}"></script>
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
   <script src="{{ asset('js/moment.min.js') }}"></script>
   <script src="{{ asset('js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('js/jquery.selectric.min.js') }}"></script>
 <!-- Template JS File -->
 <script src="{{ asset('js/scripts.js') }}"></script>
 <script src="{{ asset('js/custom.js') }}"></script>
 <script src="{{ asset('js/toast/iziToast.min.js') }}"></script>
 <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js">
 </script>
 <script src="{{ asset('js/global.js') }}">
 </script>

 <!-- Page Specific JS File -->
 <script src="{{ asset('js/form.js') }}"></script>
</body>
</html>