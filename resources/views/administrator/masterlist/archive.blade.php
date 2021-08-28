@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Modal -->
@include('administrator/masterlist/partial/modal')
{{-- Modal end --}}

<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Archive Masterlist</h2>

                </div>
                <div class="col-lg-2 col-md-2">
                    <div class="float-right mb-3">
                        <div class="form-row align-items-center mt-3 ml-4 pb-0">

                            <div class="col-auto my-1">
                                <select class="custom-select mr-sm-2" name="archiveType">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-body mt-2 pb-0 pt-1">
                    {{-- <div class="table-responsive"> --}}
                    {{-- dt-responsive nowrap --}}
                    <table class="table table-striped" id="archiveTable">
                        <thead>
                            <tr>
                                <th>LRN</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    {{-- </div> --}}
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
<script src="{{ asset('administrator/masterlist/archive.js') }}"></script>
@endsection