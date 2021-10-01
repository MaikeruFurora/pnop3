@extends('../layout/app')
@section('moreCss')
{{-- <link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Section and Subject</h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row mb-3">
                            <div class="col-lg-1 col-md-1 colsm-12 mb-2">
                                <label class="my-2">Filter:</label>
                            </div>
                            <div class="col-lg-1 col-md-1 colsm-12 mb-2">
                                <select name="grade_level_top" class="custom-select" required>
                                    <option value=""></option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 colsm-12 mb-2">
                                <select name="showSection" class="form-control select2">
                                </select>
                            </div>
                        </div>
                        </form>
                        <div class="table-responsive pb-0">
                            <table class="table table-striped" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Descriptive Title</th>
                                        <th>Subject Teacher</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="assignTable">
                                    <tr>
                                        <td colspan="5" class="text-center">No available data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body m-1">
                        <form id="AssignForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>Grade Level</label>
                                <select name="grade_level" class="custom-select" required>
                                    {{-- <option selected>Choose...</option> --}}
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Class</label>
                                <select name="section_id" class="form-control select2" required></select>
                            </div>
                            <div class="form-group">
                                <label>Subject</label>
                                <select name="subject_id" class="form-control select2" required></select>
                            </div>

                            <div class="form-group">
                                <label>Subject Teacher</label>
                                <select name="teacher_id" class="form-control select2" required>
                                    <option value=""></option>
                                    @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">
                                        {{ $teacher->teacher_lastname.', '.$teacher->teacher_firstname.' '.$teacher->teacher_middlename }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btnSaveAssign">Submit</button>
                            <button type="submit" class="btn btn-warning cancelAssign">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
{{-- <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script> --}}
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('administrator/management/assign.js') }}"></script>
@endsection