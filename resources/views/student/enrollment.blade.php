@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body text-center">
                            @if ($eStatus['status']==200)
                            <h6 class="mt-4">{{ $eStatus['msg'] }}</h6>
                            <p class="mb-0">Section: <b>{{ $eStatus['section'].' - '.$eStatus['gl'] }}</b></p>
                            <p>School Year: <b>{{ $eStatus['ay'] }}</b></p>
                            @elseif($eStatus['status']==100)
                            <h6 class="mt-4">{{ $eStatus['msg'] }}</h6>
                            <p>School Year: <b>{{ $eStatus['ay'] }}</b></p>
                            <button class="btn btn-primary">Enroll</button>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
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