@php
    use App\Http\Controllers\AttendanceController;
    $attendances = (new AttendanceController())->viewAttendance();
@endphp

<div class="student-attendance-container">
    <h2>View Attendance</h2>
    <table id="attendanceTable" border="1">
        <thead>
            <tr>
                <th>Course Id</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $attendance->course_id }}</td>
                <td>{{ $attendance->date }}</td>
                <td>{{ $attendance->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>