<form id="studentForm" method="POST">@csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                aria-controls="nav-home" aria-selected="true">Student Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                                aria-controls="nav-profile" aria-selected="false">Parent Details</a>
                        </li>
                    </ul>


                    <form id="studentForm">@csrf
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3" id="nav-home">
                                {{-- start student details here --}}
                                <div class="form-row ">
                                    <div class="form-group col-md-6">
                                        <label>Learning Reference Number</label>
                                        <input type="text" name="roll_no" required class="form-control"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Curriculum</label>
                                        <select name="student_type" required class="custom-select">
                                            <option selected>Choose...</option>
                                            <option value="STEM">STEM - Science Technology Engineering and Mathematics
                                            </option>
                                            <option value="BEC">BEC - Basic Education Curriculum</option>
                                            <option value="SPA">SPA - Special Program Art</option>
                                            <option value="SPJ">SPJ - Special Program Journalism</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="student_firstname" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle name</label>
                                        <input type="text" class="form-control" name="student_middlename" required>
                                    </div>
                                    <div class=" form-group col-md-4">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="student_lastname" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Region</label>
                                        <select name="region" id="region" class="custom-select"></select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Province</label>
                                        <select name="province" id="province" class="custom-select"></select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Town</label>
                                        <select name="city" id="city" class="custom-select"></select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Barangay</label>
                                        <select name="barangay" id="barangay" class="custom-select"></select>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address">
                                </div> --}}
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" placeholder="DD/MM/YYYY"
                                            name="date_of_birth">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Gender</label>
                                        <select class="custom-select" name="gender">
                                            <option selected>Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="student_contact"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                {{-- end student details here --}}
                            </div>
                            <div class="tab-pane fade mt-3" id="nav-profile">
                                {{-- start parent details here --}}
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Mother's name</label>
                                        <input type="text" class="form-control" name="mother_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="mother_contact_no"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Father's name</label>
                                        <input type="text" class="form-control" name="father_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="father_contact_no"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Guardian's name</label>
                                        <input type="text" class="form-control" name="guardian_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="guardian_contact_no"
                                            onkeypress="return numberOnly(event)">
                                    </div>
                                </div>
                                {{-- end parent details here --}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-warning pl-2 pr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pl-4 pr-4" id="btnSaveStudent">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>