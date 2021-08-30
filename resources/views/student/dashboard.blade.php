@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-lg-12 mt-3 mb-0">
            <div class="row">
                <div class="col-lg-2">
                    <p><b>Enrollment Status:</b>
                        @if (empty($enrolledData->enroll_status))
                        <span class="badge badge-warning">Ongoing</span>
                        @else
                        <span class="badge badge-info">{{ $enrolledData->enroll_status }}</span>
                        @endif
                    </p>
                </div>
                <div class="col-lg-2">
                    <p> <b>Section:</b>
                        @if (empty($enrolledData->section_name))
                        <span class="badge badge-warning">N/A</span>
                        @else
                        <span class="badge badge-info"> {{ $enrolledData->section_name }}</span></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="hero text-white hero-bg-image"
                style="background-image: url('assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg');">
                <div class="hero-inner">
                    <h2>Welcome, {{ Auth::user()->fullname }}!</h2>
                    <p class="lead">You almost arrived, complete the information about your account.</p>
                    <div class="mt-4">
                        <a href="{{ route('student.profile') }}"
                            class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i>
                            Setup Profile</a>
                    </div>
                </div>
            </div>

            <div class="card card-success mt-4">
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
                                <td>Must enroll in remedial classes for learning areas with failing mark and obtain a
                                    Recomputed Final Grade (RFG) of at least <b>75</b> or higher to be promoted to the
                                    next
                                    grade level or semester <br><br>
                                    If the RFG is below <b>75</b>, the learner must be re-assessed immediately for
                                    instructional intervention. If the learner still fails in the intervention, he/she
                                    is allowed to enroll in the next grade level in the succeeding school year with
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
</section>
@endsection