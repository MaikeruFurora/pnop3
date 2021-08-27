@extends('../layout/app')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">
            Student: {{ $student->student_lastname.', '.$student->student_firstname.' '.$student->student_middlename }}
        </h2>
        <div class="col-12">
            <div class="card">

                <div class="card-body mt-2">
                    <input type="hidden" name="{{ $student->id }}">
                </div>
            </div>
        </div>
    </div>
</section>

@endsection