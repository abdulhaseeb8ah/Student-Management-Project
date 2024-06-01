@php
    use App\Http\Controllers\CourseController;
    $courses = (new CourseController())->getCourses();
    $faculties = (new CourseController())->getFaculties();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="assign-course-container">
    <h2>Assign Courses</h2>
    <form id="assignForm">
        @csrf
        <label for="course">Select Course:</label>
        <select name="course_id" id="course">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
            @endforeach
        </select><br><br>
        <label for="faculty">Select Faculty:</label>
        <select name="faculty_id" id="faculty">
            @foreach ($faculties as $faculty)
                <option value="{{ $faculty->id }}">{{ $faculty->username }}</option>
            @endforeach
        </select><br><br>
        <input type="submit" value="Assign">
    </form>
</div>

<script src="{{ asset('js/student.js') }}"></script>