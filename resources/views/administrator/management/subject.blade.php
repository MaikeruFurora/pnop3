@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Subject</h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <div class="form-row align-items-center mt-3 ml-4 pb-0">

                                <div class="col-auto my-1">
                                    <select class="custom-select mr-sm-2" id="selectedGL">
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 11px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Code</th>
                                        <th>Descriptive Title</th>
                                        <th>Type</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subjectTable">
                                    <tr>
                                        <td colspan="6" class="text-center">No available data</td>
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
                        <form id="subjectForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>Grade Level</label>
                                <select name="grade_level" class="form-control" required>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subject Code</label>
                                <input type="text" class="form-control" name="subject_code" required>
                            </div>
                            <div class="form-group">
                                <label>Descriptive Title</label>
                                <input type="text" class="form-control" name="descriptive_title" required>
                            </div>
                            <div class="form-group" id="forJHS">
                                <label>Type</label>
                                <select name="subject_for" class="form-control">
                                    <option value="GENERAL">General</option>
                                    <option value="STEM">STEM - Science Technology Engineering and Mathematics</option>
                                    <option value="BEC">BEC - Basic Education Curriculum</option>
                                    <option value="SPA">SPA - Special Program Art</option>
                                    <option value="SPJ">SPJ - Special Program Journalism</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btnSaveSubject">Submit</button>
                            <button type="submit" class="btn btn-warning cancelSubject">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
        <!--
        
            for senior high

        -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Configure
                    </div>
                    <div class="card-body">
                        <form id="shsForm">@csrf
                            <input type="hidden" name="shs_id">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="custom-select" name="shs_indicate_type" required>
                                        <option value="">Choose...</option>
                                        <option value="Core">Core</option>
                                        <option value="Specialized">Specialized</option>
                                        <option value="Applied">Applied</option>
                                    </select>
                                    <select class="custom-select" name="shs_grade_level">
                                        <option value="">Grade Level</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select class="custom-select" name="shs_strand_id">
                                        <option value="">Strand</option>
                                        @forelse ($strands as $item)
                                        <option value="{{ $item->id }}">{{ $item->strand }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    <input type="text" class="form-control" placeholder="Subject Code"
                                        name="shs_subject_code" required>
                                    <input type="text" class="form-control" placeholder="Decriptive Title"
                                        name="shs_descriptive_title" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btnSHSsave pl-4 pr-4" type="submit">Save</button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-warning cancelSHS" type="button">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped" id="shsTable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Grade level</th>
                                    <th>Strand</th>
                                    <th>Subject Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Action Taken</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>>
<script src="{{ asset('administrator/management/subject.js') }}"></script>
<script src="{{ asset('administrator/management/subject.shs.js') }}"></script>
@endsection