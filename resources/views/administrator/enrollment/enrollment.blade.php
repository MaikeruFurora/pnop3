@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Enrollee's Today</h2>

                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="form-group my-3">
                        <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">Filter</span>
                                </div>
                                <select class="custom-select mr-sm-2" name="selectedGL">
                                    <option value="all">All</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                </select>
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="button" name="btnExport">Export Enrollee</button>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="">
                    {{-- table-responsive--}}
                    <table class="table table-striped" id="enrollmentTable" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th>LRN</th>
                                <th>Student name</th>
                                <th>Curriculum | Strand</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Balik Aral</th>
                                <th>Enrolled Date</th>
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
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/enrollment/enrollment.js') }}"></script>
@endsection