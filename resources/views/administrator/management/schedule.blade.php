@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Schedule</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body pb-1">
                                <div class=" mb-3">
                                    <form>
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="my-2">Search by:</label>
                                            </div>
                                            <div class="col">
                                                <select name="search_type" class="custom-select" required>
                                                    <option value=""></option>
                                                    <option value="section">Section</option>
                                                    <option value="teacher">Teacher</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="exactValue" class="form-control select2" id="mySelect2">
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div><!-- col-lg-8 -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-body pb-1">
                                {{-- <label class="d-flex showME">Narra</label> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped" style="font-size: 13px">
                                        <thead>
                                            <tr>
                                                <th width="1%">#</th>
                                                <th width="7%">Section</th>
                                                <th>Descriptive Title</th>
                                                <th>Subject Teacher</th>
                                                <th>Day(s)</th>
                                                <th>Time</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="scheduleTable">
                                            <tr>
                                                <td colspan="7" class="text-center">No available data</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body m-1">
                        <form id="scheduleForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>Grade Level</label>
                                <select name="grade_level" class="custom-select" required>
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
                            <div class="form-group">
                                <label class="d-block">Day(s)</label>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" id="monday" name="monday"
                                        value="true">
                                    <label class="custom-control-label" style="font-size: 12px"
                                        for="monday">Monday</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" id="tuesday" name="tuesday"
                                        value="true">
                                    <label class="custom-control-label" style="font-size: 12px"
                                        for="tuesday">Tuesday</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" id="wednesday" name="wednesday"
                                        value="true">
                                    <label class="custom-control-label" style="font-size: 12px"
                                        for="wednesday">Wednesday</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" id="thursday" name="thursday"
                                        value="true">
                                    <label class="custom-control-label" style="font-size: 12px"
                                        for="thursday">Thursday</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" id="friday" name="friday"
                                        value="true">
                                    <label class="custom-control-label" style="font-size: 12px"
                                        for="friday">Friday</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <select name="sched_from" class="custom-select"></select>
                                </div>
                                <div class="form-group  col-md-6">
                                    <select name="sched_to" class="custom-select"></select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btnSaveSchedule">Submit</button>
                            <button type="submit" class="btn btn-warning cancelSchedule">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('administrator/management/schedule.js') }}"></script>
@endsection