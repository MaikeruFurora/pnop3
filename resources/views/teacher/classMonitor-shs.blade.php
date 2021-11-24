@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap.min.css') }}"> --}}
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">My Class [ {{ Auth::user()->section->section_name }} ]</h2>
                </div>
                <div class="col-lg-2 col-md-2 my-4">
                    <div class="float-right ">
                        <select class="custom-select my-1 mr-sm-2" name="term">
                            <option value="1st" @if ($activeAY->first_term=='Yes') selected @endif>First Semester</option>
                            <option value="2nd"  @if ($activeAY->second_term=='Yes') selected @endif>Second Semester</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-info">
            <div class="card-body pb-1">

                <div class="table-responsive">
                    <table class="table table-striped" id="myClassTable" style="font-size: 11px">
                        <thead>
                            <tr>
                                <th>LRN</th>
                                <th>Student name</th>
                                <th>Gender</th>
                                <th>Contact No.</th>
                                <th>Status</th>
                                <th width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
{{-- <script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script> --}}
<script src="{{ asset('teacher/classMonitor.shs.js') }}"></script>
@endsection