<div class="row">
    {{-- grade 11 first sem --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td colspan="1">
                        Grade Level: <b>11</b>
                    </td>
                    <td colspan="4">
                        Term: <b>First Semester</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Section:
                        <span class="badge badge-info">{{  $recordElevenFirst[0]->section_name ??'N/A' }}</span>
                    </td>
                    <td colspan="4" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordElevenFirst[0]->fullname ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="2" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($recordElevenFirst as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'final-shs') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'remark-shs') }}
                        @php
                        $elevenFirst++;
                        $sumElevenFirst+=computedGrade($item->first,$item->second,null,null,'final-shs')
                        @endphp
                    </th>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="2" class="text-center">General Average</th>
                    <th>{{ $elevenFirst!=0? round($sumElevenFirst/$elevenFirst):'0' }}</th>
                    <th colspan="1">
                        {{ $elevenFirst!=0? round($sumElevenFirst/$elevenFirst)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- grade 11 second sem --}}
    
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td colspan="1">
                        Grade Level: <b>11</b>
                    </td>
                    <td colspan="4">
                        Term: <b>Second Semester</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Section:
                        <span class="badge badge-info">{{  $recordElevenSecond[0]->section_name ??'N/A' }}</span>
                    </td>
                    <td colspan="4" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordElevenSecond[0]->fullname ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="2" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($recordElevenSecond as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'final-shs') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'remark-shs') }}
                        @php
                        $elevenSecond++;
                        $sumElevenSecond+=computedGrade($item->first,$item->second,null,null,'final-shs')
                        @endphp
                    </th>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="2" class="text-center">General Average</th>
                    <th>{{ $elevenSecond!=0? round($sumElevenSecond/$elevenSecond):'0' }}</th>
                    <th colspan="1">
                        {{ $elevenSecond!=0? round($sumElevenSecond/$elevenFirst)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- grade 12 first sem --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td colspan="1">
                        Grade Level: <b>12</b>
                    </td>
                    <td colspan="4">
                        Term: <b>First Semester</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Section:
                        <span class="badge badge-info">{{  $recordTwelveFirst[0]->section_name ??'N/A' }}</span>
                    </td>
                    <td colspan="4" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordTwelveFirst[0]->fullname ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="2" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($recordTwelveFirst as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'final-shs') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'remark-shs') }}
                        @php
                        $twelveFirst++;
                        $sumTwelveFirst+=computedGrade($item->first,$item->second,null,null,'final-shs')
                        @endphp
                    </th>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="2" class="text-center">General Average</th>
                    <th>{{ $twelveFirst!=0? round($sumTwelveFirst/$twelveFirst):'0' }}</th>
                    <th colspan="1">
                        {{ $twelveFirst!=0? round($sumTwelveFirst/$twelveFirst)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- grade 12 second sem --}}
    
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td colspan="1">
                        Grade Level: <b>12</b>
                    </td>
                    <td colspan="4">
                        Term: <b>Second Semester</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Section:
                        <span class="badge badge-info">{{  $recordTwelveSecond[0]->section_name ??'N/A' }}</span>
                    </td>
                    <td colspan="4" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordTwelveSecond[0]->fullname ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="2" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($recordTwelveSecond as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'final-shs') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,null,null,'remark-shs') }}
                        @php
                        $twelveSecond++;
                        $sumTwelveSecond+=computedGrade($item->first,$item->second,null,null,'final-shs')
                        @endphp
                    </th>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="2" class="text-center">General Average</th>
                    <th>{{ $twelveSecond!=0? round($sumTwelveSecond/$twelveSecond):'0' }}</th>
                    <th colspan="1">
                        {{ $twelveSecond!=0? round($sumTwelveSecond/$twelveSecond)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

</div>