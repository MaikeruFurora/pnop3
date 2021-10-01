@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">My Profile</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-info">
                    <form id="studentForm">@csrf
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee ID</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ auth()->user()->roll_no }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ auth()->user()->teacher_firstname }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Middle name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ auth()->user()->teacher_middlename }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Last name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    value="{{ auth()->user()->teacher_lastname }}">
                            </div>
                            <button type="submit" class="btn btn-primary" disabled>Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-info">
                    <div class="card-header">
                        Account
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->username }}">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" disabled>Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@section('moreJs')
{{-- <script src="{{ asset('student/profile.js') }}"></script> --}}
@endsection