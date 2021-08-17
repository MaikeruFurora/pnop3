@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<!-- Modal -->
@include('teacher/chairman/partial/enrollForm')
@include('teacher/chairman/partial/setSectionForm')
@include('teacher/chairman/partial/listEnrolled')
{{-- Modal end --}}
<section class="section">
    <input type="hidden" name="current_curriculum" value="STEM">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Enrolle's Today [ STEM Student ] </h2>
                    <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so
                        on.
                    </p>
                </div>
                <div class="col-lg-2 col-md-2">
                    <button class="btn float-right btn-primary my-4" id="btnModalStudent">
                        <i class="fas fa-plus-circle"></i>&nbsp;Student
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row sectionListAvailable mb-3"></div>
                <div class="card">
                    <div class="card-body">

                        {{-- <div class="table-responsive"> --}}

                        <table class="table table-striped" style="font-size: 11px;" id="tableCurriculum">
                            <thead>
                                <tr>
                                    <th>LRN</th>
                                    <th>Fullname</th>
                                    <th width="10%">Section</th>
                                    <th>Status</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="6" class="text-center">No available data</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>


        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('teacher/chairman/enroll.js') }}"></script>
<script src="{{ asset('teacher/chairman/stem.js') }}"></script>
@endsection