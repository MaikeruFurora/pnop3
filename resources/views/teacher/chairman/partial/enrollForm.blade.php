<input type="hidden" name="current_glc" value="{{ Auth::user()->chairman->grade_level }}">
<form id="enrollForm" method="POST">@csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enroll Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <input type="hidden" name="id">
                    <div class="form-row">

                        @if (Auth::user()->chairman->grade_level==7)
                        <div class="form-group col-lg-6">
                            <label>LRN (Learning Reference Number)</label>
                            <input type="text" class="form-control" name="roll_no" pattern="^[0-9]{12}$"
                                onkeypress="return numberOnly(event)" maxlength="12" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="nothing"></option>
                                <option value="new">Incomming grade 7</option>
                                <option value="transferee">Transferee</option>
                            </select>
                        </div>
                        @else
                        <div class="form-group col-lg-6">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="nothing"></option>
                                <option value="upperclass">Upper Class</option>
                                <option value="transferee">Transferee</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>LRN (Learning Reference Number)</label>
                            <input type="text" class="form-control" name="roll_no" pattern="^[0-9]{12}$"
                                onkeypress="return numberOnly(event)" maxlength="12" required>
                        </div>
                        @endif

                        <div class="form-group col-lg-6">
                            <label>Grade level to Enroll</label>
                            <select name="grade_level" class="form-control" id="" required>
                                <option></option>
                                <option value="7">Grade 7</option>
                                <option value="8">Grade 8</option>
                                <option value="9">Grade 9</option>
                                <option value="10">Grade 10</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Curriculum</label>
                            <select name="curriculum" class="form-control" required>
                                <option value=""></option>
                                <option value="STEM">STEM - Science Technology Engineering and Mathematics</option>
                                <option value="BEC">BEC - Basic Education Curriculum</option>
                                <option value="SPA">SPA - Special Program Art</option>
                                <option value="SPJ">SPJ - Special Program Journalism</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="last_school">
                        <label>Last school attended</label>
                        <input type="text" class="form-control" name="last_school_attended" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4">
                            <label>First name</label>
                            <input type="text" class="form-control" name="student_firstname" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Middle name</label>
                            <input type="text" class="form-control" name="student_middlename">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Last name</label>
                            <input type="text" class="form-control" name="student_lastname" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control" required name="date_of_birth">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" name="student_contact" pattern="^[0-9]{11}$"
                                onkeypress="return numberOnly(event)" maxlength="11" required>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Section</label>
                            <select name="section_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-row" id="notUpper">
                        <div class="form-group col-lg-3">
                            <label>Region</label>
                            <select name="region_text" id="region" class="custom-select">
                                {{-- <option value="region"></option> --}}
                            </select>
                            <input type="hidden" name="region">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Province</label>
                            <select name="province_text" id="province" class="custom-select">
                                {{-- <option value="province"></option> --}}
                            </select>
                            <input type="hidden" name="province">
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Town</label>
                            <select name="city_text" id="city" class="custom-select">
                                {{-- <option value="city"></option> --}}

                                <input type="hidden" name="city">
                            </select>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>Barangay</label>
                            <select name="barangay_text" id="barangay" class="custom-select">
                                {{-- <option value="barangay"></option> --}}
                            </select>
                            <input type="hidden" name="barangay">
                        </div>
                    </div>
                    <div class="form-group" id="forUpper">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <label>Father's name</label>
                            <input type="text" class="form-control" name="father_name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" name="father_contact_no" pattern="^[0-9]{11}$"
                                onkeypress="return numberOnly(event)" maxlength="11">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <label>Mother's name</label>
                            <input type="text" class="form-control" name="mother_name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" name="mother_contact_no" pattern="^[0-9]{11}$"
                                onkeypress="return numberOnly(event)" maxlength="11">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <label>Guardian's name</label>
                            <input type="text" class="form-control" name="guardian_name">
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" name="guardian_contact_no" pattern="^[0-9]{11}$"
                                onkeypress="return numberOnly(event)" maxlength="11">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modalClose">Close</button>
                    <button type="submit" class="btn btn-primary btnSaveEnroll">&nbsp;&nbsp;Enroll&nbsp;&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
</form>