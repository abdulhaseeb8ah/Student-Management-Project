@php
    use App\Http\Controllers\CourseController;

    $courseController = (new CourseController())->index();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="show-courses-container">
    <h2>Course List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Faculty Name</th>
                <th>Actions</th> <!-- New column for register button -->
            </tr>
        </thead>
        <tbody>
            @foreach($courseController['courses'] as $courseName => $course)
                <tr>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->faculty_username }}</td>
                    <td>
                        <button class="register-course" data-course-id="{{ $course->id }}">Register</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Register Courses</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Faculty Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courseController['enrolledCourses'] as $courseName => $enrolledCourse)
                <tr>
                    <td>{{ $enrolledCourse->id }}</td>
                    <td>{{ $enrolledCourse->course->course_name }}</td>
                    <td>{{ $enrolledCourse->faculty_username }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="{{ asset('js/student_dashboard.js') }}"></script>