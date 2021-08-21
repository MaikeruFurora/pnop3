@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">My Grade</h2>
        <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so
            on.
        </p>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-1">

                    <div class="">
                        <div class="float-left">
                            <span style="font-size: 15px"
                                class="txtSubjectName badge badge-warning pt-1 pb-1 mt-2"></span>
                        </div>
                        {{-- table-responsive--}}
                        <table class="table  table-bordered table-hover" id="myClassTable" style="font-size: 14px">
                            <thead class="bg-dark ">
                                <tr>
                                    <th class="text-white">Subjects</th>
                                    <th class="text-center text-white" width="8%">1st</th>
                                    <th class="text-center text-white" width="8%">2nd</th>
                                    <th class="text-center text-white" width="8%">3rd</th>
                                    <th class="text-center text-white" width="8%">4th</th>
                                    <th class="text-center text-white" width="8%">Avg</th>
                                    <th class="text-center text-white" width="8%">Remarks</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tbody id="gradeTable">
                                <tr>
                                    <td colspan="7" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection