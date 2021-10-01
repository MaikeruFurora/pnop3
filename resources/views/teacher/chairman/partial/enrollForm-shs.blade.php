<input type="hidden" name="current_glc" value="{{ Auth::user()->chairman->grade_level }}">
<form id="enrollForm" method="POST">@csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content pb-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enroll Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-row">
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
                                <div class="form-group col-lg-6">
                                    <input type="hidden" name="grade_level"
                                        value="{{ Auth::user()->chairman->grade_level }}">
                                    <label>Term</label>
                                    <select name="term_enroll" class="form-control">
                                        <option value="1st">1st Term</option>
                                        <option value="2nd">2nd Term</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Strand & Specialization</label>
                                    <select name="strand_id" class="form-control" required>
                                        @foreach ($strands as $item)
                                        <option value="{{ $item->id }}">{{ $item->strand.'-'.$item->description }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
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
                                <div class="form-group col-lg-6">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" required name="date_of_birth">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label>Contact No.</label>
                                    <input type="text" class="form-control" name="student_contact" pattern="^[0-9]{11}$"
                                        onkeypress="return numberOnly(event)" maxlength="11" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Section</label>
                                    <select name="section_id" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-row" id="notUpper">
                                <div class="form-group col-lg-6">
                                    <label>Region</label>
                                    <select name="region_text" id="region" class="custom-select">
                                        {{-- <option value="region"></option> --}}
                                    </select>
                                    <input type="hidden" name="region">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Province</label>
                                    <select name="province_text" id="province" class="custom-select">
                                        {{-- <option value="province"></option> --}}
                                    </select>
                                    <input type="hidden" name="province">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label>Town</label>
                                    <select name="city_text" id="city" class="custom-select">
                                        {{-- <option value="city"></option> --}}

                                        <input type="hidden" name="city">
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Barangay</label>
                                    <select name="barangay_text" id="barangay" class="custom-select">
                                        {{-- <option value="barangay"></option> --}}
                                    </select>
                                    <input type="hidden" name="barangay">
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
                                        pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
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
                                        pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-8">
                                    <label>Guardian's name</label>
                                    <input type="text" class="form-control" name="guardian_name">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label>Contact No.</label>
                                    <input type="text" class="form-control" name="guardian_contact_no"
                                        pattern="^[0-9]{11}$" onkeypress="return numberOnly(event)" maxlength="11">
                                </div>

                            </div>
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