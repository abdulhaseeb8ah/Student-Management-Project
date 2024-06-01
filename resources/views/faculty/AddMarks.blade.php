@php
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\MarksController;
    $courses = (new CourseController())->getCourses();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="faculty-courses-container">
    <h2>Upload Marks</h2>
    <form id="uploadForm">
        @csrf
        <label for="course_id">Select Course:</label>
        <select name="course_id" id="course_id">
            <option value="0">Select course</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
            @endforeach
        </select>
        <br><br>
        <label for="student_id">Select Student:</label>
        <select name="student_id" id="student_id"></select>
        <br><br>
        <div class="marks-inputs" style="display: none;">
            <label for="assignment_marks">Assignment Marks:</label>
            <input type="text" name="assignment_marks" id="assignment_marks" required>
            <br><br>
            <label for="quiz_marks">Quiz Marks:</label>
            <input type="text" name="quiz_marks" id="quiz_marks" required>
            <br><br>
            <label for="mid1_marks">Midterm 1 Marks:</label>
            <input type="text" name="mid1_marks" id="mid1_marks" required>
            <br><br>
            <label for="mid2_marks">Midterm 2 Marks:</label>
            <input type="text" name="mid2_marks" id="mid2_marks" required>
            <br><br>
            <label for="final_marks">Final Exam Marks:</label>
            <input type="text" name="final_marks" id="final_marks" required>
            <br><br>
        </div>
        <input type="submit" value="Upload Marks">
    </form>
    <div id="message"></div> 
</div>

<script src="{{ asset('js/faculty.js') }}"></script>