@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<!-- Modal -->



{{-- Modal end --}}
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Enroll Student | Grade {{ auth()->user()->chairman_info->grade_level }}
                        Chairman</h2>
                </div>
                <div class="col-lg-2 col-md-2">
                    <button class="btn float-right btn-primary my-4" id="btnModalStudent">
                        <i class="fas fa-plus-circle"></i>&nbsp;Student
                    </button>
                </div>
            </div>
        </div>
        <div class="row">

        </div><!-- row -->
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
{{-- <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script> --}}
<script src="{{ asset('teacher/chairman/enroll.js') }}"></script>
<script src="{{ asset('teacher/chairman/stem.js') }}"></script>
@endsection