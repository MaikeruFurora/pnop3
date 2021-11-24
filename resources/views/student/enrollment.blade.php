@extends('../layout/app')
@section('content')
{{-- Modal --}}
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <div class="modal-body pt-5 text-center">
            <p>
                Make sure the information you provide throughout the enrolling process is accurate so that your information can be processed quickly and correctly.
            </p>
            <div class="">
                <button type="button" class="btn btn-primary btn-sm btnCheckandVerify">Enroll Now</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
  </div>
{{-- Modal end --}}
<section class="section">
    <div class="section-body">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>INFORMATION</h4>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Enrollment Status:
                                                    <span class="badge @if ($dataArr['status']=='Enrolled')
                                                    badge-primary
                                                    @else
                                                    badge-warning
                                                    @endif  badge-pill">
                                                        {{ $dataArr['status'] }}
                                                    </span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Section:
                                                    <span class="badge badge-primary badge-pill">
                                                        {{ $dataArr['section']??'None' }}
                                                    </span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Grade Level:
                                                    <span class="badge badge-primary badge-pill">
                                                        {{ $dataArr['grade_level']??'None' }}
                                                    </span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Action taken:
                                                    <span class="badge badge-primary badge-pill">
                                                        {{ $dataArr['action_taken']??'None' }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                @if(Auth::user()->grade()->where('avg','<','75')->whereNull('remarks')->get()->count()!=0)
                                <div class="col-md-6 col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>OTHERS</h4>
                                        </div>
                                        <div class="card-body">

                                            <p>
                                                Back Subject:
                                                <span class="badge badge-danger">
                                                    {{ Auth::user()->grade()->where('avg','<','75')->where('remarks')->get()->count() }}
                                                </span><br>
                                                <small>* Note
                                                    <em> Must enroll in remedial classes for learning areas with
                                                        failing mark
                                                        and obtain at least 75 or higher</em>
                                                </small>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6 col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>Enrollment</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="student_id" value="{{ Auth::user()->id }}">

                                            @if ($dataArr['status']=='Pending')
                                            <button class="btn btn-primary" disabled>
                                                Waiting for Sectioning
                                            </button>
                                            <p class="mt-3">Enrollment No. <span class="badge badge-warning badge-pill">{{ $dataArr['tracking_no'] }}</span></p>
                                            <p class="mt-3"><b>Note: </b>If your enrollment is taking too long and the enrollment date has passed, you can contact the grade level chairman for your grade level to process your enrollment.</p>
                                            @elseif($dataArr['status']=='Enrolled')
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <input id="my-input" readonly class="form-control" type="text" name="" value="{{ $dataArr['curriculum']??'None' }}">
                                                </div>
                                                <div class="form-group col-6">
                                                 <input type="text" readonly class="form-control" value="{{ $dataArr['grade_level']??'None' }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input id="my-input" readonly class="form-control" type="text" name="" value="@if($dataArr['curriculum']=='STEM')Science, Technology, Engineering and Mathematics @elseif($dataArr['curriculum']=='BEC')Basic Education for Art @elseif($dataArr['curriculum']=='SPJ')Special Program for Journalis @else None @endif
                                                ">
                                            </div>
                                            <button class="btn btn-primary" disabled>FINALIZED <small>(Enrolled)</small></button>
                                            @else
                                            <span class="badge badge-warning badge-pill noteTxt mb-3"></span>
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <input id="my-input" readonly class="form-control" type="text" name="" value="{{ $dataArr['curriculum']??'None' }}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <select name="" class="form-control" required>
                                                        <option value="">Grade Level to Enroll</option>
                                                        <option value="7">Grade 7</option>
                                                        <option value="8">Grade 8</option>
                                                        <option value="9">Grade 9</option>
                                                        <option value="10">Grade 10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input id="my-input" readonly class="form-control" type="text" name="" value="@if($dataArr['curriculum']=='STEM')Science, Technology, Engineering and Mathematics @elseif($dataArr['curriculum']=='BEC')Basic Education for Art @elseif($dataArr['curriculum']=='SPJ')Special Program for Journalis @else None @endif
                                                ">
                                            </div>
                                            <button type="submit" class="btn btn-primary promptModal">Proceed</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header card-success">
                            <h5> <i class="fa fa-bell"></i>&nbsp;&nbsp;&nbsp;Reminders</h5>
                        </div>
                        <div class="card-body">
                            <h6>Learner Promotion and Retention for Grades 7 to 10</h6>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Requirements</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Final grade of at least <b>75</b> in all learning areas</td>
                                        <td><span class="text-success">Promoted</span> to the next grade level</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Did not meet expectations in not more than two learning areas</td>
                                        <td>Must enroll in remedial classes for learning areas with failing mark and
                                            obtain a
                                            Recomputed Final Grade (RFG) of at least <b>75</b> or higher to be promoted
                                            to the
                                            next
                                            grade level or semester <br><br>
                                            If the RFG is below <b>75</b>, the learner must be re-assessed immediately
                                            for
                                            instructional intervention. If the learner still fails in the intervention,
                                            he/she
                                            is allowed to enroll in the next grade level in the succeeding school year
                                            with
                                            continuous provision of tutorial services (DO 13, s. 2018)</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            Did not meet expectations in three or more learning areas
                                        </td>
                                        <td>
                                            more learning areas Retained in the same grade level
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('student/enrollment.js') }}"></script>
@endsection