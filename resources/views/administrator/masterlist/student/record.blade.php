@extends('../layout/app')
@section('content')
<section class="section">
    @php
    $sum7=0;
    $sum8=0;
    $sum9=0;
    $sum10=0;
    $sumElevenFirst=0;
    $sumElevenSecond=0;
    $sumTwelveFirst=0;
    $sumTwelveSecond=0;
    $seven=0;
    $eight=0;
    $nine=0;
    $ten=0;
    $elevenFirst=0;
    $elevenSecond=0;
    $twelveFirst=0;
    $twelveSecond=0;
    function computedGrade($first=null,$second=null,$third=null,$fourth=null, $need){
        switch ($need) {
            case 'final':
                if (!empty($first) && !empty($second) && !empty($third) && !empty($fourth)) {
                    $final = intval($first) + intval($second) + intval($third) + intval($fourth);
                    return round($final / 4);
                }
            break;
            case 'final-shs':
                if (!empty($first) && !empty($second)) {
                    $final = intval($first) + intval($second) ;
                    return round($final / 2);
                }
            break;
            case 'remark':
                if (!empty($first) && !empty($second) && !empty($third) && !empty($fourth)) {
                    $final = intval($first) + intval($second) + intval($third) + intval($fourth);
                    return round($final / 4)<75?'Failed':'Passed';
                }
            break;
            case 'remark-shs':
                if (!empty($first) && !empty($second)) {
                    $final = intval($first) + intval($second) + intval($third) + intval($fourth);
                    return round($final / 2)<75?'Failed':'Passed';
                }
            break;
            case 'term':
                if (!empty($first) && !empty($second)) {
                    $final = intval($first) + intval($second);
                    return round($final / 2)<75?'Failed':'Passed';
                }
            break;
            default: 
                return false; 
            break;
        } 
     }
      @endphp 
      <div class="section-body">
        <h2 class="section-title">
            Student: <b>{{ $student->student_lastname.', '.$student->student_firstname.' '.$student->student_middlename }}</b>
        </h2>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a href="{{ url()->previous() }}" class="nav-link"><i class="fa fa-arrow-left"></i> Back</a>
                          </li>
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Junior High</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Senior High</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                            {{-- tab junior --}}
                            @include('administrator.masterlist.student.junior')
                            {{-- tab junior --}}
                        </div>
                        <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            {{-- tab senior high --}}
                            @include('administrator.masterlist.student.senior')
                            {{-- tab senior high --}}
                        </div>
                        
                      </div>
                </div>
            </div>
            
        </div>
</section>
@endsection