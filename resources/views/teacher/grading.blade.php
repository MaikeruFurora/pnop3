@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<style>
    .failGrade {
        color: red;
    }

    .noborder {
        border: none;
        border-color: transparent;
    }
</style>
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Grading</h2>
                    <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so
                        on.
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 my-4">
                    <div class="float-right ">

                        <form class="form-inline ">
                            <label class="my-1 mr-2" for="filterLabel">Sections</label>
                            <select name="filterMyLoadSection" class="custom-select my-1 mr-sm-2" id="filterLabel">
                            </select>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body pb-1">

                <div class="">
                    {{-- table-responsive--}}
                    <table class="table  table-bordered table-hover" id="myClassTable" style="font-size: 14px">
                        <thead class="bg-dark ">
                            <tr>
                                <th class="text-white">Student name</th>
                                <th class="text-center text-white" width="8%">1st</th>
                                <th class="text-center text-white" width="8%">2nd</th>
                                <th class="text-center text-white" width="8%">3rd</th>
                                <th class="text-center text-white" width="8%">4th</th>
                                <th class="text-center text-white" width="8%">Avg</th>
                                <th class="text-center text-white" width="8%">Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="gradingTable">
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
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
<script src="{{ asset('teacher/grading.js') }}"></script>
@endsection