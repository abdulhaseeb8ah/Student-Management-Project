<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="add-courses-container">
        <h2>Add Courses</h2>
        <form id="add-course-form">
            @csrf
            <input type="text" id="course_code" name="course_code" placeholder="Enter course code" required><br><br>
            <input type="text" id="course_name" name="course_name" placeholder="Enter course name" required><br><br>
            <input type="submit" value="Add Course">
        </form>
    </div>
    <script src="{{ asset('js/dashboard.js') }}"></script>