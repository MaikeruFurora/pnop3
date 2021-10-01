@extends('../layout/app')
@section('content')
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
                                            <button type="submit"
                                                class="btn btn-primary btnCheckandVerify">Enroll</button>
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