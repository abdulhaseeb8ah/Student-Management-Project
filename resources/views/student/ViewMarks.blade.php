@php
    use App\Http\Controllers\MarksController;
    $marks = (new MarksController())->viewMarks();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="student-marks-container">
        <h2>View Marks</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Assignment Marks</th>
                    <th>Quiz Marks</th>
                    <th>Midterm 1 Marks</th>
                    <th>Midterm 2 Marks</th>
                    <th>Final Exam Marks</th>
                    <th>Total Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marks as $mark)
                <tr>
                    <td>{{ $mark->course_name }}</td>
                    <td>{{ $mark->assignment_marks}}</td>
                    <td>{{ $mark->quiz_marks}}</td>
                    <td>{{ $mark->mid1_marks}}</td>
                    <td>{{ $mark->mid2_marks}}</td>
                    <td>{{ $mark->final_marks}}</td>
                    <td>{{ $mark->total_marks}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>