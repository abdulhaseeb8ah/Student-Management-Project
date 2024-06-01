@php
    use App\Http\Controllers\CourseController;
    $courses = (new CourseController())->getCourses();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="faculty-courses-container">
        <h2>Upload Attendance</h2>
        <form id="uploadForm2">
            @csrf
            <label for="course_id2">Select Course:</label>
            <select name="course_id2" id="course_id2">
                <option value="0">Select course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
            <br><br>
            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" required>
            <br><br>
            <div id="students-table">
            </div>
            <br>
            <input type="submit" name="upload" value="Upload">
        </form>
</div>

<script src="{{ asset('js/faculty.js') }}"></script>