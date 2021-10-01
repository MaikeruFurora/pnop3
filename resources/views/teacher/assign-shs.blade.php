@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@include('teacher/partial/assign-subject-shs')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Assign Subject [ {{ Auth::user()->section->section_name }} ]</h2>
                </div>
                <div class="col-lg-2 col-md-2 my-4">
                    @if (empty($activeAY))
                    <p>No active academic year</p>
                    @else
                    <div class="float-right ">
                        <select class="custom-select my-1 mr-sm-2" name="term">
                            @if ($activeAY->first_term=="Yes")
                            <option value="1st">1st Term</option>
                            @endif
                            @if ($activeAY->second_term=="Yes")
                            <option value="2nd">2nd Term</option>
                            @endif
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-body">
                <nav class="mt-3">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                            role="tab" aria-controls="nav-home" aria-selected="true">My Class Subject</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Enroll Subject</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('teacher/partial/assignSubjectTable')
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @include('teacher/partial/assignStudentSubject')
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('teacher/assign.shs.js') }}"></script>
<script src="{{ asset('teacher/showAssign.shs.js') }}"></script>
@endsection