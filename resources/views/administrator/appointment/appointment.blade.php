@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
@include('administrator/appointment/partial/holidayForm')
<section class="section">
    <div class="section-body">
        <div class="col-12">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-md-8">
                    <h2 class="section-title">Appointment List</h2>

                </div>
                <div class="col-lg-2 col-md-2">
                    <button class="btn float-right btn-primary my-4" id="btnModalHoliday">
                        <i class="fas fa-plus-circle"></i>&nbsp;Add Holiday
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">

                    </div>
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
<script src="{{ asset('administrator/appointment/appointment.js') }}"></script>
@endsection