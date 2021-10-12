<table>
    <thead>
        <tr>
            <th>Section &amp; Semester:</th>
            <th colspan="4">{{ $data[0]->section_name }} &amp; {{ $data[0]->term }} Semester</th>
        </tr>
        <tr>
            <th>Grade Level:</th>
            <th colspan="4">Grade {{ $data[0]->grade_level }}</th>
        </tr>
        <tr>
            <th>Subject:</th>
            <th colspan="4">{{ $data[0]->descriptive_title }}</th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th colspan="3" style="text-align: center">Quarter</th>
        </tr>
        <tr>
            <th>LRN</th>
            <th>Student name</th>
            <th>1st</th>
            <th>2nd</th>
            <th>Avg</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->roll_no }}</td>
                <td>{{ $item->fullname }}</td>
                <td>{{ $item->first }}</td>
                <td>{{ $item->second }}</td>
                <td>{{ $item->avg }}</td>
            </tr>
        @endforeach
    </tbody>
</table>