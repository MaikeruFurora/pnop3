@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <input type="hidden" name="current_curriculum" value="BEC">
    <div class="section-body">
        <h2 class="section-title">Assign Subject
        </h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row sectionListAvailable mb-3"></div>
                <div class="card card-info">
                    <div class="card-body">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <form id="assignForm">@csrf
                                <input type="hidden" name="id">
                                <div class="form-row mb-3">
                                    <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                                        <select name="subject_id" class="custom-select">
                                            <option value="">Choose subject</option>
                                            @foreach ($subjects as $item)
                                            <option value="{{ $item->id }}">[ {{ $item->subject_code }} ] -
                                                {{ $item->descriptive_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                                        <select name="teacher_id" class="select2 custom-select">
                                            <option value="">Choose subject teacher</option>
                                            @foreach ($teachers as $item)
                                            <option value="{{ $item->id }}">{{ $item->teacher_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-1">
                                        <button class="btn btn-primary pl-4 pr-4 btn-lg assignBtn"
                                            type="submit">Save</button>
                                        <button class="btn btn-warning pl-4 pr-4 btn-lg cancelNow"
                                            type="submit">Cancel</button>
                                    </div>
                                </div>
                                <input type="hidden" name="section_id" value="{{  Auth::user()->section_info->id }}">
                                <input type="hidden" name="grade_level"
                                    value="{{  Auth::user()->section_info->grade_level }}">
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Name</th>
                                        <th>Subject Teacher</th>
                                        <th width="13%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableAssign">
                                </tbody>
                            </table>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>

        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('teacher/assign.js') }}"></script>
@endsection