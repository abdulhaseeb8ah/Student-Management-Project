$(document).ready(function() {
   
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('#add-course-form').submit(function(e){
        e.preventDefault();
        console.log('coming');
        var formData = $(this).serialize();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/AddCourse',
            data: formData,
            success: function(response){
                alert(response.message); 
                $('#add-course-form')[0].reset();
            },
            error: function(xhr, status, error) {
                alert('An error occurred while adding the course');
            }
        });
    });

    $('#assignForm').submit(function(e){
        e.preventDefault();
        console.log('com');
        var formData = $(this).serialize();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/AssignCourse',
            data: formData,
            success: function(response){
                alert(response);
            },
            error: function(xhr, status, error){
                $('#message').html('<div class="error-message">Error: ' + error + '</div>'); 
            }
        });
    });


});
