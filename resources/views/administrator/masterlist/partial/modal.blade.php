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
                        <input type="hidden" name="id">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active mt-3" id="nav-home">
                                {{-- start student details here --}}
                                <div class="form-row ">
                                    <div class="form-group col-md-4">
                                        <label>Learning Reference Number</label>
                                        <input type="text" name="roll_no" required class="form-control"
                                            pattern="^[0-9]{12}$" onkeypress="return numberOnly(event)" maxlength="12">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Balik Aral</label>
                                        <select name="isbalik_aral" class="custom-select" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last school year attended</label>
                                        <input type="text" class="form-control" name="last_schoolyear_attended">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>First name</label>
                                        <input type="text" class="form-control" name="student_firstname" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle name</label>
                                        <input type="text" class="form-control" name="student_middlename">
                                    </div>
                                    <div class=" form-group col-md-4">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" name="student_lastname" required>
                                    </div>
                                </div>

                                <div class="form-row" id="forNew">
                                    <div class="form-group col-md-3">
                                        <label>Region</label>
                                        <select name="region_text" id="region" class="custom-select" required></select>
                                        <input type="hidden" name="region">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Province</label>
                                        <select name="province_text" id="province" class="custom-select"
                                            required></select>
                                        <input type="hidden" name="province">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Town</label>
                                        <select name="city_text" id="city" class="custom-select" required></select>
                                        <input type="hidden" name="city">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Barangay</label>
                                        <select name="barangay_text" id="barangay" class="custom-select"
                                            required></select>
                                        <input type="hidden" name="barangay">
                                    </div>
                                </div>

                                <div class="form-row" id="forUpdate">
                                    <div class="form-group col-md-3">
                                        <label>Region</label>
                                        <input type="text" name="region_update" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Province</label>
                                        <input type="text" name="province_update" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Town</label>
                                        <input type="text" name="city_update" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Barangay</label>
                                        <input type="text" name="barangay_update" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" class="form-control" placeholder="DD/MM/YYYY"
                                            name="date_of_birth">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Gender</label>
                                        <select class="custom-select" name="gender" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="student_contact"
                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Last school attended</label>
                                    <input type="text" class="form-control" name="last_school_attended" required>
                                </div> --}}



                                {{-- end student details here --}}
                            </div>
                            <div class="tab-pane fade mt-3" id="nav-profile">
                                {{-- start parent details here --}}
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Father's name</label>
                                        <input type="text" class="form-control" name="father_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="father_contact_no"
                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label>Mother's name</label>
                                        <input type="text" class="form-control" name="mother_name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control" name="mother_contact_no"
                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
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
                                            pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
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