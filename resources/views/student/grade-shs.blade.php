@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">My Grade&nbsp;&nbsp;&nbsp;<span style="font-size: 15px"
                            class="txtSectionName badge badge-warning pt-1 pb-1"></span></h2>
                </div>
                <div class="col-lg-3 col-md-3 my-4">
                    <div class="float-right ">
                        @if (!empty($activeAY))
                            @if ($activeAY->first_term=="Yes")
                            <input type="hidden" name="active_term" value="1st">
                            @endif
                            @if ($activeAY->second_term=="Yes")
                            <input type="hidden" name="active_term" value="2nd">
                            @endif
                        @endif
                        <form class="form-inline ">
                            <select name="filterGradeLevel" class="custom-select my-1 mr-sm-2" id="filterLabel">
                            </select>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card card-info">
                <div class="card-body pb-1">
                    <div class="">
                        <div class="float-left">
                            <span style="font-size: 15px"
                                class="txtSubjectName badge badge-warning pt-1 pb-1 mt-2"></span>
                        </div>
                        {{-- table-responsive--}}
                        <div class="table-responsive">
                            <table class="table  table-bordered table-hover" id="myClassTable" style="font-size: 14px">
                                <thead class="bg-info ">
                                    <tr>
                                        {{-- <th class="text-white">Teacher</th> --}}
                                        <th class="text-white">Subjects</th>
                                        <th class="text-center text-white " width="8%">1st</th>
                                        <th class="text-center text-white " width="8%">2nd</th>
                                        <th class="text-center text-white " width="8%">Avg</th>
                                        <th class="text-center text-white " width="8%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tbody id="gradeTable">
                                    <tr>
                                        {{-- <td colspan="8" class="text-center text-white">No data available</td> --}}
                                        <td colspan="7" class="text-center">No data available</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-info">
                                        <td colspan="3" class="text-right text-white"><b>Final Average</b></td>
                                        <td id="overallGrade" class="text-center text-white "></td>
                                        <td id="overallRemark" class="text-center text-white "></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('student/grade.shs.js') }}"></script>
@endsection