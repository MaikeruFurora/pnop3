<table>
    <thead>
        <tr>
            <th>Section:</th>
            <th colspan="6">{{ $data[0]->section_name }}</th>
        </tr>
        <tr>
            <th>Grade Level:</th>
            <th colspan="6">Grade {{ $data[0]->grade_level }}</th>
        </tr>
        <tr>
            <th>Subject:</th>
            <th colspan="6">{{ $data[0]->descriptive_title }}</th>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th colspan="5">Quarterly Rating</th>
        </tr>
        <tr>
            <th>LRN</th>
            <th>Student name</th>
            <th>1st</th>
            <th>2nd</th>
            <th>3rd</th>
            <th>4th</th>
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
                <td>{{ $item->third }}</td>
                <td>{{ $item->fourth }}</td>
                <td>{{ $item->avg }}</td>
            </tr>
        @endforeach
    </tbody>
</table>