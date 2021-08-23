@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <div class="col-12 mb-4">
            <div class="hero text-white hero-bg-image mt-3"
                style="background-image: url('assets/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg');">
                <div class="hero-inner">
                    <h2>Welcome, {{ Auth::user()->fullname }}!</h2>
                    <p class="lead">You almost arrived, complete the information about your account.</p>
                    <div class="mt-4">
                        <a href="{{ route('student.profile') }}"
                            class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i>
                            Setup Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection