@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Assign Subject [ {{ Auth::user()->section->section_name }} ]</h2>
                </div>
                <div class="col-lg-2 col-md-2 my-4">
                    @if (empty($activeAY))
                    <p>No active academic year</p>
                    @else
                    <div class="float-right ">
                        <select class="custom-select my-1 mr-sm-2" name="term">
                            <option value="1st" @if ($activeAY->first_term=='Yes') selected @endif>First Semester</option>
                            <option value="2nd"  @if ($activeAY->second_term=='Yes') selected @endif>Second Semester</option>
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-body">
                <form id="assignForm">@csrf
                    <div class="form-group">
                        <div class="select-group">
                            <div class="row">
                                <div class="col-lg-4">
                                    <select class="my-2 custom-select select2" name="subject_id" required>
                                        
                                        {{-- @foreach ($subjects as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->subject_code.' > '.$item->descriptive_title }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="my-2 custom-select select2" name="teacher_id" required>
                                        <option value="">Choose subject teacher...</option>
                                        @foreach ($teachers as $item)
                                        <option value="{{ $item->id }}">{{ $item->teacher_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <input type="hidden" name="term_assign">
                                <div class="col-lg-2">
                                    <button class="my-2 btn btn-block btn-primary assignBtn " type="submit">Save</button>
                                </div>
                                <div class="col-lg-2">
                                    <button class="my-2 btn btn-block btn-warning cancelNow" type="button">Cancel</button>
                                </div>
                            </div>
        
                        </div>
                    </div>
                </form>

                {{--  --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-table-bordered">
                           <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Teacher</th>
                                    <th>Action</th>
                                </tr>
                           </thead>
                            <tbody id="tableAssign"></tbody>
                        </table>
                    </div>
                {{--  --}}
            </div>
        </div>

    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('teacher/assign.shs.js') }}"></script>
<script src="{{ asset('teacher/showAssign.shs.js') }}"></script>
@endsection