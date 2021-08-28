@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">My Profile</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <form id="studentForm">@csrf
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="card-body">
                            <div class="form-row ">
                                <div class="form-group col-lg-4">
                                    <label>Learning Reference Number</label>
                                    <input type="text" name="roll_no" required class="form-control" readonly
                                        value="{{ auth()->user()->roll_no }}">
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label>First name</label>
                                    <input type="text" class="form-control" name="student_firstname"
                                        value="{{ auth()->user()->student_firstname }}" required>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Middle name</label>
                                    <input type="text" class="form-control" name="student_middlename"
                                        value="{{ auth()->user()->student_middlename }}">
                                </div>
                                <div class=" form-group col-lg-4">
                                    <label>Last name</label>
                                    <input type="text" class="form-control" name="student_lastname"
                                        value="{{ auth()->user()->student_lastname }}" required>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-lg-4">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" placeholder="DD/MM/YYYY"
                                        name="date_of_birth" value="{{ auth()->user()->date_of_birth }}">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Gender</label>
                                    <input type="text" class="form-control" name="gender"
                                        value="{{ auth()->user()->gender }}">
                                </div>


                                <div class="form-group col-lg-4">
                                    <label>Contact No.</label>
                                    <input type="text" class="form-control" name="student_contact"
                                        onkeypress="return numberOnly(event)"
                                        value="{{ auth()->user()->student_contact }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-3">
                                    <label>Region</label>
                                    <input type="text" class="form-control" name="region"
                                        value="{{ auth()->user()->region }}" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>Province</label>
                                    <input type="text" class="form-control" name="province"
                                        value="{{ auth()->user()->province }}">
                                </div>
                                <div class=" form-group col-lg-3">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city"
                                        value="{{ auth()->user()->city }}" required>
                                </div>
                                <div class=" form-group col-lg-3">
                                    <label>Barangay</label>
                                    <input type="text" class="form-control" name="barangay"
                                        value="{{ auth()->user()->barangay }}" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-8">
                                    <label>Mother's name</label>
                                    <input type="text" class="form-control" name="mother_name"
                                        value="{{ auth()->user()->mother_name }}">
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
                                        value="{{ auth()->user()->father_name }}">
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
                                        value="{{ auth()->user()->guardian_name }}">
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
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
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
            </div>

        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('student/profile.js') }}"></script>
@endsection