<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td>

                        Section:
                        <span class="badge badge-info">{{  $recordSeven[0]->section_name ??'N/A' }}</span>
                    </td>
                    <td colspan="6" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordSeven[0]->fullname ?? 'N/A' }}
                        </span> &nbsp;&nbsp;
                        Grade Level: <b>7</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="4" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($recordSeven as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    <th>{{ $item->third }}</th>
                    <th>{{ $item->fourth }}</th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'final') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'remark') }}
                        @php
                        $seven++;
                        $sum7+=computedGrade($item->first,$item->second,$item->third,$item->fourth,'final')
                        @endphp
                    </th>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <th colspan="4" class="text-center">General Average</th>
                    <th>{{ $seven!=0? round($sum7/$seven):'0' }}</th>
                    <th colspan="1">
                        {{ $seven!=0? round($sum7/$seven)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- EIGHT --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td>

                        Section:
                        <span
                            class="badge badge-info">{{  $recordEight[0]->section_name?? 'N/A' }}</span>
                    </td>
                    <td colspan="6" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordEight[0]->fullname?? 'N/A' }}
                        </span> &nbsp;&nbsp;
                        Grade Level: <b>8</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="4" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>

                </tr>
            </thead>
            <tbody>
                @if (!empty($recordEight))
                @foreach ($recordEight as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    <th>{{ $item->third }}</th>
                    <th>{{ $item->fourth }}</th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'final') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'remark') }}
                        @php
                        $eight++;
                        $sum8+=computedGrade($item->first,$item->second,$item->third,$item->fourth,'final')
                        @endphp
                    </th>
                </tr>
                @endforeach
                @endif
                <tr>
                    <th></th>
                    <th colspan="4" class="text-center">General Average</th>
                    <th>{{ $eight!=0? round($sum8/$eight):'0' }}</th>
                    <th colspan="1">
                        {{ $eight!=0? round($sum8/$eight)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- NINE --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td>

                        Section:
                        <span
                            class="badge badge-info">{{  $recordNine[0]->section_name?? 'N/A' }}</span>
                    </td>
                    <td colspan="6" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordNine[0]->fullname?? 'N/A' }}
                        </span> &nbsp;&nbsp;
                        Grade Level: <b>9</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="4" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>

                </tr>
            </thead>
            <tbody>
                @if (!empty($recordNine))
                @foreach ($recordNine as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    <th>{{ $item->third }}</th>
                    <th>{{ $item->fourth }}</th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'final') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'remark') }}
                        @php
                        $nine++;
                        $sum9+=computedGrade($item->first,$item->second,$item->third,$item->fourth,'final')
                        @endphp
                    </th>
                </tr>
                @endforeach
                @endif
                <tr>
                    <th></th>
                    <th colspan="4" class="text-center">General Average</th>
                    <th>{{ $nine!=0? round($sum9/$nine):'0' }}</th>
                    <th colspan="1">
                        {{ $nine!=0? round($sum9/$nine)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    {{-- TEN --}}
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <td>
                        Section:
                        <span
                            class="badge badge-info">{{  $recordTen[0]->section_name?? 'N/A' }}</span>
                    </td>
                    <td colspan="6" class="text-center">
                        Class Adviser:
                        <span class="badge badge-info pt-1 pb-1">
                            {{  $recordTen[0]->fullname?? 'N/A' }}
                        </span> &nbsp;&nbsp;
                        Grade Level: <b>10</b>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">LEARNING AREAS</td>
                    <td colspan="4" class="text-center">Quarterly Rating</td>
                    <td rowspan="2" class="text-center">Final Rating</td>
                    <td rowspan="2">Remarks</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>

                </tr>
            </thead>
            <tbody>
                @if (!empty($recordTen))
                @foreach ($recordTen as $item)
                <tr>
                    <th>{{ $item->descriptive_title }}</th>
                    <th>{{ $item->first }}</th>
                    <th>{{ $item->second }}</th>
                    <th>{{ $item->third }}</th>
                    <th>{{ $item->fourth }}</th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'final') }}
                    </th>
                    <th>
                        {{ computedGrade($item->first,$item->second,$item->third,$item->fourth,'remark') }}
                        @php
                        $ten++;
                        $sum10+=computedGrade($item->first,$item->second,$item->third,$item->fourth,'final')
                        @endphp
                    </th>
                </tr>
                @endforeach
                @endif
                <tr>
                    <th></th>
                    <th colspan="4" class="text-center">General Average</th>
                    <th>{{ $ten!=0? round($sum10/$ten):'0' }}</th>
                    <th colspan="1">
                        {{ $ten!=0? round($sum10/$ten)<75?'Failed':'Passed':'0' }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>