@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Back Subject&nbsp;&nbsp;&nbsp;<span style="font-size: 15px"
                class="txtSectionName badge badge-warning pt-1 pb-1"></span></h2>
        <div class="col-lg-12">
            <div class="card card-info">
                <div class="card-body pb-1">
                    <div class="">
                        <div class="float-left">
                            <span style="font-size: 15px"
                                class="txtSubjectName badge badge-warning pt-1 pb-1 mt-2"></span>
                        </div>
                        {{-- table-responsive--}}
                        <table class="table  table-bordered table-hover" id="myClassTable" style="font-size: 14px">
                            <thead class="bg-info ">
                                <tr>
                                    <th class="text-white">Subjects</th>
                                    <th class="text-center text-white">Final Rating</th>
                                    <th class="text-center text-white">Recomputed Final Grade</th>
                                    <th class="text-center text-white">Conducted From</th>
                                    <th class="text-center text-white">Conducted To</th>
                                    <th class="text-center text-white">Remarks</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tbody id="backsubjectTable">
                                <tr>
                                    <td colspan="5" class="text-center">No data available</td>
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
@section('moreJs')
<script src="{{ asset('student/backsubject.js') }}"></script>
@endsection