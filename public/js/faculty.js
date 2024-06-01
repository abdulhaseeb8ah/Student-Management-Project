$(document).ready(function() {
    $('#course_id').change(function() {
        var courseId = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/faculty/getstudents',
            data: { course_id: courseId },
            success: function(response) {
                var options = '';
                $.each(response, function(index, student) {
                    options += '<option value="' + student.id + '">' + student.username + '</option>';
                });
                $('#student_id').html(options);
                if ($('#student_id').find('option').length > 0) {
                    $('.marks-inputs').show();
                } else {
                    $('.marks-inputs').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred while fetching enrolled students. Please try again later.');
            }
        });
    });

    $('#uploadForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/faculty/uploadmarks',
            data: formData,
            success: function(response) {
                $('#message').html('<div class="success-message">' + response.message + '</div>'); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#message').html('<div class="error-message">Error: ' + error + '</div>'); 
            }
        });
    });
    var courseId;
    $('#course_id2').change(function() {
        courseId = $(this).val();
        console.log('com');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/faculty/getstudents',
            data: {course_id: courseId},
            success: function(response) {
                $('#students-table').html(response.student_table);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred while fetching enrolled students. Please try again later.');
            }
        });
    });

    $('#uploadForm2').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var statuses = {};

        $('.attendance-status').each(function() {
            var studentId = $(this).data('student-id');
            var status = $(this).val();
            statuses[studentId] = status;
        });

        formData += '&statuses=' + JSON.stringify(statuses);
        formData += '&course_id=' + courseId;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/faculty/uploadattendance',
            data: formData,
            success: function(response) {
                if (response.trim() === "success") {
                    alert('Attendance uploaded successfully');
                } else {
                    alert('Failed to upload attendance. Please try again later.');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred while uploading attendance. Please try again later.');
            }
        });
    });
});