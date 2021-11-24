@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<!-- Modal -->
@include('teacher/chairman/partial/enrollForm-shs')
@include('teacher/chairman/partial/setSectionForm')
@include('teacher/chairman/partial/exportExcel')
@include('teacher/chairman/partial/listEnrolled')
@include('teacher/chairman/partial/viewRequirement')
@include('teacher/chairman/partial/enrollMainForm')
{{-- Modal end --}}
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Enrolle's Today [ Grade {{ Auth::user()->chairman_info->grade_level }}
                        Student
                        ]
                    </h2>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group my-4 float-right">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="btnModalExport"><i
                                        class="fas fa-file-export"></i>&nbsp;Export
                                </button>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="btnModalStudent"><i
                                        class="fas fa-plus-circle"></i>&nbsp;Student
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row sectionListAvailable mb-3"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <form id="massSectioningForm">
                                <div class="col-lg-2 float-left">
                                    <select class="custom-select mr-sm-2" name="strand">
                                        @foreach ($strands as $item)
                                        <option value="{{ $item->id }}">{{ $item->strand }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 float-left">
                                    <select class="custom-select mr-sm-2" name="term">
                                        <option value="1st" {{ $activeAY->first_term=='Yes'?'selected':'' }}>First Semester</option>
                                        <option value="2nd" {{ $activeAY->second_term=='Yes'?'selected':'' }}>Second Semester</option>
                                    </select>
                                </div>
                                <table class="table table-striped" style="font-size: 11px;" id="gradeElevenTable">
                                    <thead>
                                        <tr>
                                            <th width="10%">Enrollment No</th>
                                            <th>LRN</th>
                                            <th>Fullname</th>
                                            <th width="10%">Section</th>
                                            <th width="8%">Status</th>
                                            <th width="10%">Balik Aral</th>
                                            <th width="10%">Action Taken</th>
                                            <th width="8%">State</th>
                                            <th width="10%">Requirements</th>
                                            <th width="13%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>

                        </div>
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
{{-- <script src="{{ asset('teacher/chairman/enroll.js') }}"></script> --}}
<script src="{{ asset('teacher/chairman/enroll.shs.js') }}"></script>
<script src="{{ asset('teacher/chairman/enroll.student.shs.js') }}"></script>
<script src="{{ asset('teacher/chairman/enrollMain.js') }}"></script>
@endsection