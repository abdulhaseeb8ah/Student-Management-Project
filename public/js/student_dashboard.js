$(document).ready(function() {
    $('.register-course').click(function() {
        var courseId = $(this).data('course-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/student/registerCourse',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                course_id: courseId
            },
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});