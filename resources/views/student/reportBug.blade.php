@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Report&nbsp;&nbsp;(Something Isn't Working) <span style="font-size: 15px"
                class="txtSectionName badge badge-warning pt-1 pb-1"></span></h2>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Let us know about a broken feature
                </div>
                <div class="card-body">
                    <p>Your device and carrier information will be attached to the report.
                        Although we regularly use this data to improve the quality of the site, we do not reply to bugs
                        submitted through this form on an individual basis. </p>
                    <form action="">
                        <div class="form-group">
                            <label for="">What went wrong?</label>
                            <textarea class="form-control" data-height="150" name="" id=""></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Attach optional screenshot</label>
                            <input type="file" name="" class="form-control">
                        </div>
                        <button class="btn btn-info" disabled>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('student/backsubject.js') }}"></script>
@endsection