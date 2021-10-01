@extends('../layout/app')
@section('content')
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
                                                        {{ Auth::user()->student_info->grade_level }} &amp;
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
                                            @elseif($dataArr['status']=='Enrolled')
                                            <button class="btn btn-primary" disabled>FINALIZED</button>
                                            @else
                                            <p class="noteTxt"></p>
                                            @csrf
                                            @if ($dataArr['active_term']=='1st')
                                            <h6>First Semester enrollment was open</h6>
                                            @else
                                            <h6>Second Semester enrollment was open</h6>
                                            @endif
                                            <button type="submit"
                                                class="btn btn-primary btnCheckandVerify mt-3">Enroll</button>
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