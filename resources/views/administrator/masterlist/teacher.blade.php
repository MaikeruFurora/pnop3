@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Modal -->
<form id="teacherForm" method="POST">@csrf
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Employee ID.</label>
                        <input type="text" name="roll_no" class="form-control" required>
                        <small class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>First name</label>
                        <input type="text" name="firstname" class="form-control" required>
                        <small class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Middle name</label>
                        <input type="text" name="middlename" class="form-control" required>
                        <small class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input type="text" name="lastname" class="form-control" required>
                        <small class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- Modal end --}}

<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Teacher Masterlist</h2>
                </div>
                <div class="col-lg-2 col-md-2">
                    <button class="btn float-right btn-primary my-4" id="btnMidalTeacher">
                        <i class="fas fa-plus-circle"></i>&nbsp;Teacher
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped" id="teacherTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fullname</th>
                                    <th>Gender</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th width="8%">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/masterlist/teacher.js') }}"></script>
@endsection