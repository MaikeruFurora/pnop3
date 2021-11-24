@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Announcement</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Create post</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="announceForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="my-input">Headline</label>
                                <input id="my-input" class="form-control" type="text" name="headline" required>
                            </div>
                            <div class="form-group">
                                <label for="summernote">Content</label>
                                <textarea id="summernote" class="form-control summernote" name="content_body" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="my-select">Visible by:</label>
                                <select id="visible_by" class="form-control select2" name="visible_by[]" required multiple>
                                    <option value=""></option>
                                    <option value="1">All User</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Chairman</option>
                                    <option value="4">Student</option>
                                    <option value="5">Junior High Student</option>
                                    <option value="6">Senior High Student</option>
                                </select>
                            </div>
                            <button class="btn btn-primary btn-block createMe" type="submit">Post</button>
                            <button class="btn btn-warning btn-block clearMe" type="button">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Post announcement</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('moreJs')
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('administrator/announcement/announcement.js') }}"></script>
@endsection