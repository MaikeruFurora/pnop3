@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Dashboard</h2>
        <p class="section-lead">Active Academic Year
            :{{ empty($activeAY)?'No active academic year':'S/Y '.$activeAY->from.'-'.$activeAY->to }}</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Enrollee</h4>
                        </div>
                        <div class="card-body">
                            {{ $enrollTotal }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fa fa-users text-white" style="font-size: 20px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Student</h4>
                        </div>
                        <div class="card-body">
                            {{ $studentTotal }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fa fa-users  text-white" style="font-size:20px"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Teacher</h4>
                        </div>
                        <div class="card-body">
                            {{ $teacherTotal }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-border-all"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Section</h4>
                        </div>
                        <div class="card-body">
                            {{ $ectionTotal }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Population by Sex</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Population by Curriculum</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Population by Grade Level</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Appointment Today</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @forelse ($appointies as $item)
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-title">{{ $item->fullname }}</div>
                                    <span class="text-small text-muted">{{ $item->address }}</span>
                                </div>
                            </li>
                            @empty
                            <div class="media-body text-center">No data available</div>
                            @endforelse
                        </ul>
                        <div class="text-center pt-1 pb-1">
                            <a href="{{ route('admin.appointment') }}" class="btn btn-primary btn-lg btn-round">
                                View All
                            </a>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="card">
                    <div class="card-body pb-0">
                        <ul class="list-unstyled list-unstyled-border">
                            <li class="media">
                                <a href="#">
                                    {{-- <img class=" width=" 50" src="{{ asset('image/avatar-1.png') }}" alt="product">
                                    --}}
                                    <i class="mr-3 rounded fas fa-users" style="font-size: 40px"></i>
                                </a>
                                <div class="media-body">
                                    <div class="media-right my-2" style="font-size: 25px">{{ $njhs }}</div>
                                    <div class="media-title">Number of Junior High</div>
                                    <div class="text-muted text-small">Grade 7 to 10
                                    </div>
                                </div>
                            </li>
                            <li class="media">
                                <a href="#">
                                    <i class="mr-3 rounded fas fa-user-shield" style="font-size: 40px"></i>
                                </a>
                                <div class="media-body">
                                    <div class="media-right my-2" style="font-size: 25px">{{ $nshs }}</div>
                                    <div class="media-title">Number of Senior High</div>
                                    <div class="text-muted text-small">Grade 11 to 12
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/chart/chart.min.js') }}"></script>
<script src="{{ asset('administrator/dashboard.js') }}"></script>
@endsection