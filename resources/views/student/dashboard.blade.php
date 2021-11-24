@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-lg-12 mt-3 mb-0">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12 mb-2">
                    <button type="button" class="btn btn-info" disabled>
                        Enrollment:@if (empty($enrolledData->enroll_status))
                        <span class="badge badge-warning">Ongoing</span>
                        @else
                        <span class="badge 
                        @if ($enrolledData->enroll_status=='Pending')
                        badge-warning
                        @else
                         badge-info    
                        @endif">{{ $enrolledData->enroll_status }}</span>
                        @endif
                    </button>

                </div>
                <div class="col-lg-2 col-md-12 col-sm-12 mb-2">
                    <button type="button" class="btn btn-info" disabled>
                        &nbsp;&nbsp;&nbsp; Section: @if (empty($enrolledData->enroll_status) ||
                        $enrolledData->enroll_status=='Pending')
                        <span class="badge badge-warning">N/A</span>
                        @else
                        <span class="badge badge-info">{{ $enrolledData->section_name }}</span>
                        @endif
                        &nbsp;&nbsp;&nbsp;
                    </button>

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
        
            <h2 class="section-title">Annoucement </h2>
            @foreach ($post as $item)
                @foreach ($item->visible_by as $value)
                   @if ($value==1)
                   <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                           <h4> {{$item->headline}}</h4>
                        </div>
                        <div class="card-body">
                             <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            @php echo html_entity_decode($item->content_body) @endphp
                        </div>
                    </div>
                   </div>
                   @endif

                   @if ($value==4)
                   <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                           <h4> {{$item->headline}}</h4>
                        </div>
                        <div class="card-body">
                             <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            @php echo html_entity_decode($item->content_body) @endphp
                        </div>
                    </div>
                   </div>
                   @endif

                    @if (auth()->user()->enrollment()->whereNotNull('curriculum')->where('school_year_id', $activeAY->id)->exists())
                        @if ($value==5)
                        <div class="col-lg-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h4> {{$item->headline}}</h4>
                            </div>
                            <div class="card-body">
                                <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                                @php echo html_entity_decode($item->content_body) @endphp
                            </div>
                        </div>
                        </div>
                        @endif
                    @endif

                    @if (auth()->user()->enrollment()->whereNotNull('strand_id')->where('school_year_id', $activeAY->id)->exists())
                    @if ($value==6)
                    <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> {{$item->headline}}</h4>
                        </div>
                        <div class="card-body">
                            <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            @php echo html_entity_decode($item->content_body) @endphp
                        </div>
                    </div>
                    </div>
                    @endif
                @endif
                    
                
                @endforeach
            @endforeach

            <div class="card card-success mt-4">
                <div class="card-header card-success">
                    <h5> <i class="fa fa-bell"></i>&nbsp;&nbsp;&nbsp;Reminders</h5>
                </div>
                <div class="card-body">
                    @if (Auth::user()->completer=="No") <h6>Learner Promotion and Retention for Grades 7
                        to 10</h6>
                    <div class="table-responsive">
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
                                    <td>Must enroll in remedial classes for learning areas with failing mark and obtain
                                        a
                                        Recomputed Final Grade (RFG) of at least <b>75</b> or higher to be promoted to
                                        the
                                        next
                                        grade level or semester <br><br>
                                        If the RFG is below <b>75</b>, the learner must be re-assessed immediately for
                                        instructional intervention. If the learner still fails in the intervention,
                                        he/she
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
                    @else
                    <h6>Learner Promotion and Retention for Grades 11 and 12</h6>
                    <div class="table-responsive">
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
                                        Must pass remedial classes for failed competencies in the subject before being
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
                                        Must pass remedial classes for failed competencies in the subjects or learning
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
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>
@endsection