@if($students->isNotEmpty())
<table border="1">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->student_id }}</td>
            <td>{{ $student->username }}</td>
            <td>
                <select class="attendance-status" data-student-id="{{ $student->student_id }}">
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                </select>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif