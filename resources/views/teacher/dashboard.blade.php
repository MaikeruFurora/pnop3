@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Dashboard </h2>
        @if ( Auth::user()->chairman()->where('school_year_id', session('sessionAY')->id)->exists())
        <div class="row dashMonitor"></div>
        @endif
    </div>
</section>
@endsection
@section('moreJs')
@if ( Auth::user()->chairman()->where('school_year_id', session('sessionAY')->id)->exists())
<script src="{{ asset('teacher/chairman/dashMonitor.js') }}"></script>
@endif
@endsection