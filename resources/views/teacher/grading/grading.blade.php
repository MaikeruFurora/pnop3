@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<style>
    .failGrade {
        color: red;
    }

    .noborder {
        width: 95%;
        border: none;
        border-color: transparent;
        background: transparent;
        outline: none;
    }
</style>
@endsection
@include('teacher/grading/partial/importModal')
@section('content')
<div class="modal fade" id="fillGradeInPrevious" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="fillGradeInPreviousLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="mt-3">Please fill previous grading period</p>
                <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Grading</h2>
                </div>
                <div class="col-lg-3 col-md-3 my-4">
                        <div class="input-group">
                            <select name="filterMyLoadSection" class="custom-select" id="filterLabel">
                            </select>
                            <div class="input-group-append">
                                
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-body pb-1">
                <div class="float-left">
                    <span style="font-size: 15px" class="txtSubjectName badge badge-warning pt-1 pb-1 mt-2"></span>
                </div>
                <div class="col-lg-1 float-left">
                    <button type="button" class="btn btn-outline-primary btn-block" id="btnImport"><i
                            class="fas fa-cloud-upload-alt"></i>&nbsp;Import
                    </button>
                </div>
                <div class="col-lg-1 float-left">
                    <button class="btn btn-outline-secondary btnDownload" type="button"><i
                        class="fas fa-cloud-download-alt"></i>Template</button>
                </div>
                    {{-- table-responsive--}}
                    <div class="table responsive">
                        <table class="table  table-bordered table-hover" id="myClassTable" style="font-size: 14px">
                            <thead class="bg-info ">
                                <tr>
                                    <th class="text-white">Student name</th>
                                    <th class="text-center text-white" width="7%">1st</th>
                                    <th class="text-center text-white" width="7%">2nd</th>
                                    <th class="text-center text-white" width="7%">3rd</th>
                                    <th class="text-center text-white" width="7%">4th</th>
                                    <th class="text-center text-white" width="7%">Avg</th>
                                    <th class="text-center text-white" width="8%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            {{-- <tbody id="gradingTable">
                                <tr>
                                    <td colspan="7" class="text-center">No data available</td>
                                </tr>
                            </tbody> --}}
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
<script src="{{ asset('teacher/grading.js') }}"></script>
@endsection