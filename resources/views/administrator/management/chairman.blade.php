@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Grade Level Chairman</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form id="chairmanForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-row mb-2">
                                <div class="col-1">
                                    <select name="grade_level" class="custom-select" required>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select name="teacher_id" class="form-control select2" id="mySelect2" required>
                                        <option value=""></option>
                                        @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->teacher_lastname.', '.$teacher->teacher_firstname.' '.$teacher->teacher_middlename }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit"
                                        class="btn btn-primary my-1 pl-4 pr-4 btnSavechairman">Save</button>
                                    <button type="submit"
                                        class="btn btn-warning my-1 pl-4 pr-4 cancelchairman">Cancel</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Grade Level</th>
                                        <th>Chairman</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="chairmanTable">
                                    <tr>
                                        <td colspan="6" class="text-center">No available data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- col-lg-8 -->

        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('administrator/management/chairman.js') }}"></script>
@endsection