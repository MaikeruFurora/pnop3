@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')

<!-- Modal -->
@include('administrator/masterlist/partial/viewBackSubject')
{{-- Modal end --}}

<section class="section">
    <div class="section-body">
        <h2 class="section-title">Back Subject</h2>
        <div class="col-12">
            <div class="card">

                <div class="card-body mt-2 pb-0 pt-1">
                    {{-- <div class="table-responsive"> --}}
                    {{-- dt-responsive nowrap --}}
                    <table class="table table-striped" id="backsubjectTable">
                        <thead>
                            <tr>
                                <th>LRN</th>
                                <th>Fullname</th>
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
<script src="{{ asset('administrator/masterlist/backrecord.js') }}"></script>
@endsection