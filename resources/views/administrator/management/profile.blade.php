@extends('../layout/app')
@section('content')
{{-- <div class="section-header">
    <h1>sas</h1>
</div> --}}
<div class="modal fade" id="endModalOnlineENrollment" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="fillGradeInPreviousLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="mt-3 showText"></p>
                <button type="button" class="btn btn-warning btn-sm pl-3 pr-3 btnYes">Yes</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-secondary btn-sm btnClose">Close</button>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="section-body">
        <h2 class="section-title">School Profile</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body m-3">
                        <form enctype="multipart/form-data" id="schooProfileForm">@csrf
                            <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        <label for="inputSchoolName">School Name</label>
                                        <input type="text" class="form-control" name="school_name"
                                            value="{{ $data->school_name ?? '' }}" id="inputSchoolName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSchoolAddress">School Address</label>
                                        <input type="text" class="form-control" name="school_address"
                                            value="{{ $data->school_address ?? '' }}" id="inputSchoolAddress" required>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="inputSchoolIdNo">School Division</label>
                                            <input type="text" class="form-control" name="school_division"
                                                value="{{ $data->school_division ?? '' }}" id="inputSchoolIdNo"
                                                required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="inputSchoolIdNo">School Region</label>
                                            <input type="text" class="form-control" name="school_region"
                                                value="{{ $data->school_region ?? '' }}" id="inputSchoolIdNo" required>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label for="inputSchoolIdNo">School ID No.</label>
                                            <input type="number" class="form-control" name="school_id_no"
                                                value="{{ $data->school_id_no ?? '' }}" id="inputSchoolIdNo" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="col-form-label ">Thumbnail</label>
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="school_logo" id="image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSaveSP">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
            {{--  --}}
            @if (isset($data))
            {{empty($data->school_enrollment_url)}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body pb-">
                        <form class="form-inline" id="enrollStatusForm">@csrf
                            <div class="form-group">
                                <label for="selectEnrollmentStatus">Enrollment Status</label>
                                <select name="statusEnrollment" id="selectEnrollmentStatus" class="form-control mx-sm-3"
                                    required>
                                    <option {{ empty($data->school_enrollment_url)?'selected':'' }} value="">
                                    </option>
                                    <option {{  ($data->school_enrollment_url==true)?'selected':'' }} value="yes">
                                        Ongoing
                                    </option>
                                    <option {{ ($data->school_enrollment_url==false)?'selected':'' }} value="no">
                                        Disabled
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/uploadPreview/jquery.uploadPreview.min.js') }}"></script>
<script src="{{ asset('administrator/management/profile.js') }}"></script>
@endsection