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
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/chart/chart.min.js') }}"></script>
<script src="{{ asset('administrator/dashboard.js') }}"></script>
@endsection