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
            <div class="mb-2">
                <button type="button" class="btn btn-primary btn-sm btnCheckandVerify">Enroll Now</button>&nbsp;&nbsp;
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
            </div>
            <span class="text-danger showmessage"></span>
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
                    <div class="card">
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
                                                    <span class="badge badge-primary badge-pill">
                                                        {{ $dataArr['status'] }}
                                                    </span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Strand | Specialization:
                                                    <span
                                                        class="badge badge-primary badge-pill">{{ Auth::user()->student_info->strand }}</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Description
                                                    <span
                                                        class="badge badge-primary badge-pill">{{ Auth::user()->student_info->description }}</span>
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    Grade Level &amp; Term
                                                    <span class="badge badge-primary badge-pill">Grade
                                                        {{ $dataArr['grade_level'] ?? 'N/A' }} &amp;
                                                        {{ $dataArr['term'] }}</span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                @if(Auth::user()->backsubject()->where('back_subjects.remarks','none')->get()->count()!=0)
                                <div class="col-md-6 col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>OTHERS</h4>
                                        </div>
                                        <div class="card-body">

                                            <p>
                                                Back Subject:
                                                <span class="badge badge-danger">
                                                    {{ Auth::user()->backsubject()->where('back_subjects.remarks','none')->get()->count() }}
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
                                            <p class="mt-3"><b>Note: </b> If your enrollment is taking too long and the enrollment date has passed, you can contact the grade level chairman for your grade level to process your enrollment.</p>
                                            @elseif($dataArr['status']=='Enrolled')
                                            <div class="form-group">
                                                <input type="text" readonly class="form-control" value="{{ Auth::user()->student_info->strand.' - '.Auth::user()->student_info->description }}">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <input type="text" readonly class="form-control" value="Grade {{ Auth::user()->student_info->grade_level }}">
                                                </div>
                                               <div class="form-group col-6">
                                                    <input type="text" readonly class="form-control" value="{{ $dataArr['term'] }}">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" disabled>FINALIZED <small>(Enrolled)</small></button>
                                            @else
                                            <span class="badge badge-warning badge-pill noteTxt mb-3"></span>
                                            @csrf
                                            @if ($dataArr['active_term']=='1st')
                                            <h6>First Semester enrollment was open</h6>
                                           <div class="form-group">
                                                <input type="text" readonly class="form-control" value="{{ Auth::user()->student_info->strand.' - '.Auth::user()->student_info->description }}">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <select class="form-control" name="first_term_grade_level" required>
                                                        <option value="">Grade level to Enroll</option>
                                                        <option value="11">Grade 11</option>
                                                        <option value="12">Grade 12</option>
                                                    </select>
                                               </div>
                                               <div class="form-group col-6">
                                                    <input type="text" readonly class="form-control" value="First Semester">
                                                </div>
                                            </div>
                                           
                                            @else
                                            <h6>Second Semester enrollment was open</h6>
                                           <div class="form-row">
                                               <div class="form-group col-6">
                                                <input type="text" readonly class="form-control" value="{{ Auth::user()->student_info->strand.' - '.Auth::user()->student_info->description }}">
                                               </div>
                                               <div class="form-group col-6">
                                                <input type="text" readonly class="form-control" value="Second Semester">
                                               </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-6">
                                                    <select class="form-control" name="second_term_grade_level" required>
                                                        <option value="">Grade level to Enroll</option>
                                                        <option value="11" @if ($dataArr['grade_level']=='11') selected @endif>Grade 11</option>
                                                        <option value="12" @if ($dataArr['grade_level']=='12') selected @endif>Grade 12</option>
                                                    </select>
                                               </div>
                                               <div class="form-group col-6">
                                                <select class="form-control" name="second_term_section_id" readonly>
                                                    <option value="{{ $dataArr['section_id'] }}">{{ $dataArr['section'] }}</option>
                                                </select>
                                           </div>
                                            </div>
                                            @endif
                                            <button type="submit" class="btn btn-primary promptModal">Proceed</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

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
                            </div>

                        </div>
                    </div>
                    <div class="card card-success">
                        <div class="card-header card-success">
                            <h5> <i class="fa fa-bell"></i>&nbsp;&nbsp;&nbsp;Reminders</h5>
                        </div>
                        <div class="card-body">
                            <h6>Learner Promotion and Retention for Grades 11 and 12</h6>
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
                                        <td>Final grade of at least 75 in all learning areas in a semester</td>
                                        <td>Can <span class="text-success">proceed</span> to the next semester</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Did not meet expectations in a prerequisite subject in a learning area</td>
                                        <td>
                                            Must pass remedial classes for failed competencies in the subject before
                                            being
                                            allowed to enroll in the higher-level subject
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            Did not meet expectations in any subject or learning area at the end of the
                                            semester
                                        </td>
                                        <td>
                                            Must pass remedial classes for failed competencies in the subjects or
                                            learning
                                            areas to be allowed to enroll in the next semester

                                            Otherwise, the learner must retake the subjects failed
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            Passed all subjects or learning areas in Senior High School
                                        </td>
                                        <td>
                                            Earn the Senior High School Certificate
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
<script src="{{ asset('student/enrollment.shs.js') }}"></script>
@endsection