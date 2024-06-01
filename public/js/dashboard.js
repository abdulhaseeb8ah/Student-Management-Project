$(document).ready(function() {
   
    $("#home").click(function(e) {
        e.preventDefault(); 
        $.ajax({
            url: "Home.php",
            type: "GET",
            success: function(data) {
                $("#content-container").html(data);
            }
        });
    });
    
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.confirm-btn').click(function() {
        console.log('confirm clicked');
        var $button = $(this); 
        var requestId = $button.data('request-id');
        var roleId = $button.data('role-id');
        console.log(requestId);
        var action = 'confirm';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/admin/ProcessRequest",
            data: { action: action, requestId: requestId, roleId: roleId }, 
            success: function(response) 
            {
                $button.closest('.user').remove();
                alert('Request confirmed successfully'); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred while confirming the request');
            }
        });
    });
    

    $('.reject-btn').click(function() {
        console.log('reject clicked');
        var $button = $(this); 
        var requestId = $button.data('request-id');
        var roleId = $button.data('role-id');
        console.log(requestId);
        var action = 'reject';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/admin/ProcessRequest",
            data: { action: action, requestId: requestId, roleId: roleId }, 
            success: function(response) 
            {
                $button.closest('.user').remove();
                alert('Request rejected successfully'); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred while rejecting the request');
            }
        });
    });

    $('.block-btn').click(function() {
        var $button = $(this); 
        var requestId = $button.data('request-id');
        var roleId = $button.data('role-id');
        console.log(requestId);
        var action = 'block';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/admin/UserStatus",
            data: { action: action, requestId: requestId, roleId: roleId }, 
            success: function(response) 
            {
                $button.closest('.user').remove();
                alert('User blocked successfully'); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred while confirming the request');
            }
        });
    });

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

    $('.unblock-btn').click(function() {
        var $button = $(this); 
        var requestId = $button.data('request-id');
        var roleId = $button.data('role-id');
        console.log(requestId);
        var action = 'unblock';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/admin/UserStatus",
            data: { action: action, requestId: requestId, roleId: roleId },
            success: function(response) 
            {
                $button.closest('.user').remove();
                alert('User unblocked successfully'); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); 
                alert('An error occurred while rejecting the request');
            }
        });
    });

    $('.menu-item').click(function(event) {
        event.preventDefault();
        var pageName = $(this).attr('id');

        $.ajax({
            url: '/' + role +'/' + pageName,
            type: 'GET',
            success: function(response) {
                $('#content').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.error('Status: ' + status);
                console.dir(xhr);
                $('#content').html('<p>An error occurred while loading the page. Please try again later.</p>');
            }
        });
    });

});
