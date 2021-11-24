@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">My Profile</h2>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card profile-widget">
                      <div class="profile-widget-header">     
                          @if (!empty(auth()->user()->profile_image))
                          <img alt="Profile pictur of {{ auth()->user()->student_firstname }}" src="{{ asset('image/profile/'.auth()->user()->profile_image) }}" class="rounded-circle profile-widget-picture">
                          @else
                          <img alt="image" src="{{ asset('image/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                          @endif                
                        <div class="profile-widget-items">
                          <div class="profile-widget-item">
                            <div class="profile-widget-item-label">LRN</div>
                            <div class="profile-widget-item-value">{{ auth()->user()->roll_no }}</div>
                          </div>
                          <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Status</div>
                            <div class="profile-widget-item-value">Active</div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="profile-widget-description">
                       
                        <form id="studentForm">@csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="student_firstname"
                                            value="{{ auth()->user()->student_firstname }}" readonly  >
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Middle name</label>
                                        <input type="text" class="form-control" name="student_middlename"
                                            value="{{ auth()->user()->student_middlename }}" readonly >
                                    </div>
                                    <div class=" form-group col-lg-4">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="student_lastname"
                                            value="{{ auth()->user()->student_lastname }}" readonly  >
                                    </div>
                                </div>
    
    
                                <div class="form-row">
                                    <div class="form-group col-lg-4">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" placeholder="DD/MM/YYYY"
                                            name="date_of_birth" value="{{ auth()->user()->date_of_birth }}" readonly >
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Gender</label>
                                        <input type="text" class="form-control" name="gender"
                                            value="{{ auth()->user()->gender }}" readonly >
                                    </div>
    
    
                                    <div class="form-group col-lg-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="student_contact"
                                            onkeypress="return numberOnly(event)"
                                            value="{{ auth()->user()->student_contact }}" >
                                    </div>
                                </div>
    
                                <div class="form-row">
                                    <div class="form-group col-lg-3">
                                        <label>Region</label>
                                        <input type="text" class="form-control" name="region"
                                            value="{{ auth()->user()->region }}" readonly  >
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label>Province</label>
                                        <input type="text" class="form-control" name="province"
                                            value="{{ auth()->user()->province }}" readonly >
                                    </div>
                                    <div class=" form-group col-lg-3">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city"
                                            value="{{ auth()->user()->city }}" readonly  >
                                    </div>
                                    <div class=" form-group col-lg-3">
                                        <label>Barangay</label>
                                        <input type="text" class="form-control" name="barangay"
                                            value="{{ auth()->user()->barangay }}" readonly  >
                                    </div>
                                </div>
    
                                <div class="form-row">
                                    <div class="form-group col-lg-8">
                                        <label>Mother's name</label>
                                        <input type="text" class="form-control" name="mother_name"
                                            value="{{ auth()->user()->mother_name }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="mother_contact_no"
                                            value="{{ auth()->user()->mother_contact_no }}"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-8">
                                        <label>Father's name</label>
                                        <input type="text" class="form-control" name="father_name"
                                            value="{{ auth()->user()->father_name }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="father_contact_no"
                                            value="{{ auth()->user()->father_contact_no }}"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-8">
                                        <label>Guardian's name</label>
                                        <input type="text" class="form-control" name="guardian_name"
                                            value="{{ auth()->user()->guardian_name }}" readonly>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="guardian_contact_no"
                                            value="{{ auth()->user()->guardian_contact_no }}"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-round btn-primary float-right btnSave mb-4">
                                    Save
                                </button>
                        </form>

                      </div><!-- profile-witdget-descipriton -->
                     
                    </div>

            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card mt-4 card-primary">
                    <div class="card-header">
                        Account
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->username }}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>

                {{-- upload picture --}}

                <div class="card card-info">
                    <div class="card-header">
                        Upload Picture
                    </div>
                    <div class="card-body">
                        <small>* make sure 1x1 picture</small>
                        <form id="uploadImage">@csrf
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                  <input type="file" name="file" class="custom-file-input" id="inputGroupFile02">
                                  <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-info btnImageSave">Upload</button>
                                  {{-- <span class="input-group-text" id="inputGroupFileAddon02">Upload</span> --}}
                                </div>
                              </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('student/profile.js') }}"></script>
@endsection