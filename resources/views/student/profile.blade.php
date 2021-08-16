@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">My Profile</h2>
        <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so
            on.
        </p>


        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row ">
                            <div class="form-group col-md-6">
                                <label>Learning Reference Number</label>
                                <input type="text" name="roll_no" required class="form-control" readonly
                                    value="{{ $student->roll_no }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Student Type</label>
                                <input type="text" class="form-control" name="student_type" readonly
                                    value="{{ $student->student_type }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>First name</label>
                                <input type="text" class="form-control" name="student_firstname" readonly
                                    value="{{ $student->student_firstname }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Middle name</label>
                                <input type="text" class="form-control" name="student_middlename" readonly
                                    value="{{ $student->student_middlename }}">
                            </div>
                            <div class=" form-group col-md-4">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="student_lastname" readonly
                                    value="{{ $student->student_lastname }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" readonly
                                value="{{ $student->address }}">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Date of Birth</label>
                                <input type="date" class="form-control" placeholder="DD/MM/YYYY" name="date_of_birth"
                                    readonly value="{{ $student->date_of_birth }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Gender</label>
                                <input type="text" class="form-control" name="gender" readonly
                                    value="{{ $student->gender }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Status</label>
                                <select class="custom-select" name="martial_status" readonly>
                                    <option selected>Choose...</option>
                                    <option value="New">New</option>
                                    <option value="Old">Old</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="student_contact" readonly
                                    onkeypress="return numberOnly(event)" value="{{ $student->student_contact }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Mother's name</label>
                                <input type="text" class="form-control" name="mother_name" readonly
                                    value="{{ $student->mother_name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="mother_contact_no" readonly
                                    value="{{ $student->mother_contact_no }}" onkeypress="return numberOnly(event)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Father's name</label>
                                <input type="text" class="form-control" name="father_name" readonly
                                    value="{{ $student->father_name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="father_contact_no" readonly
                                    value="{{ $student->father_contact_no }}" onkeypress="return numberOnly(event)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Guardian's name</label>
                                <input type="text" class="form-control" name="guardian_name" readonly
                                    value="{{ $student->guardian_name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact No.</label>
                                <input type="text" class="form-control" name="guardian_contact_no" readonly
                                    value="{{ $student->guardian_contact_no }}" onkeypress="return numberOnly(event)">
                            </div>
                        </div>
                    </div>
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