@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Dashboard </h2>
        @if ( Auth::user()->chairman()->where('school_year_id', session('sessionAY')->id)->exists())
        <div class="row dashMonitor"></div>
        @endif
        <div class="hero text-white hero-bg-image mb-4"
            style="background-image: url('assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg');">
            <div class="hero-inner">
                <h2>Welcome, {{ Auth::user()->fullname }}!</h2>
                <p class="lead">You almost arrived, complete the information about your account.</p>
                <div class="mt-4">
                    <a href="{{ route('teacher.profile') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                            class="far fa-user"></i>
                        Setup Profile</a>
                </div>
            </div>
        </div>
        <h2 class="section-title">Annoucement </h2>
        <div class="row">
            @foreach ($post as $item)
                @foreach ($item->visible_by as $value)
                   @if ($value==1)
                   <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                           <h4> {{$item->headline}}</h4>
                        </div>
                        <div class="card-body">
                             <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            @php echo html_entity_decode($item->content_body) @endphp
                        </div>
                    </div>
                   </div>
                   @endif
                   @if ($value==2)
                   <div class="col-lg-12">
                    <div class="card card-warning">
                        <div class="card-header">
                           <h4> {{$item->headline}}</h4>
                        </div>
                        <div class="card-body">
                             <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            @php echo html_entity_decode($item->content_body) @endphp
                        </div>
                    </div>
                   </div>
                   @endif
                   @if (Auth::user()->chairman()->where('school_year_id', $activeAY->id)->exists())
                  @if ($value==3)
                  <div class="col-lg-12">
                   <div class="card card-warning">
                       <div class="card-header">
                          <h4> {{$item->headline}}</h4>
                       </div>
                       <div class="card-body">
                            <p><i class="fa fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                           @php echo html_entity_decode($item->content_body) @endphp
                       </div>
                   </div>
                  </div>
                  @endif
                  @endif
                @endforeach
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-6">
                @if ($sectionAvail->count()!=0)
                <h6 class="section-title">My Load Section</h6>
                @endif
                <div class="row">
                    @foreach ($sectionAvail as $item)
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>{{ $item->section_name }}</h4>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-info btn-block">View Student</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- col-lg-6 -->
            {{-- <div class="col-lg-6">
                <div class="card card-warning">
                    <div class="card-body">
                        sasa
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <!--section-body-->
</section>
@endsection
@section('moreJs')
@if (Auth::user()->chairman()->where('school_year_id', session('sessionAY')->id)->exists())
@if (Auth::user()->chairman->grade_level>10)
<script src="{{ asset('teacher/chairman/dashMonitor.shs.js') }}"></script>
@else
<script src="{{ asset('teacher/chairman/dashMonitor.js') }}"></script>
@endif
@endif
@endsection