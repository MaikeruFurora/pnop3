@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
@include('administrator/management/partial/deleteModal')
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
                                <div class="col-lg-1 col-md-12 col-sm-12 mb-2">
                                    <select name="grade_level" class="custom-select" required>
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                        <option value="11">Grade 11</option>
                                        <option value="12">Grade 12</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12 mb-2">
                                    <select name="teacher_id" class="form-control select2" id="mySelect2" required>
                                        <option value=""></option>
                                        @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->teacher_lastname.', '.$teacher->teacher_firstname.' '.$teacher->teacher_middlename }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-12 col-sm-12">
                                    <button type="submit"
                                        class="btn btn-block btn-primary my-1 pl-4 pr-4 btnSavechairman">Save</button>
                                    <button type="submit"
                                        class="btn btn-block btn-warning my-1 pl-4 pr-4 cancelchairman">Cancel</button>
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