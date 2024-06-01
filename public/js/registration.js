$(document).ready(function() {
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function() {
                    var maxWidth = 200;
                    var maxHeight = 200;
                    var fileSize = input.files[0].size / 1024;
                    var allowedFormats = ['image/jpeg', 'image/png']; 

                    if (allowedFormats.indexOf(input.files[0].type) === -1) {
                        alert("Invalid image format. Please choose a PNG or JPG image.");
                        $('#profile_picture_input_trigger').val('');
                        $('#profile_picture_preview').attr('src', '');
                        return; 
                    }

                    if (this.width > maxWidth || this.height > maxHeight) 
                    {
                        alert("Image dimensions exceed the maximum allowed size (200x200). Please choose a smaller image.");
                        $('#profile_picture_input_trigger').val('');
                        $('#profile_picture_preview').attr('src', 'profile_pictures/upload.png');

                    } 
                    else if (fileSize > 1024) {
                        alert("File size exceeds the maximum allowed limit (1MB). Please choose a smaller file.");
                        $('#profile_picture_input_trigger').val('');
                        $('#profile_picture_preview').attr('src', 'profile_pictures/upload.png');

                    } 
                    else {
                        $('#profile_picture_preview').attr('src', e.target.result);
                    }
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#profile_picture_preview").click(function(){
        $("#profile_picture_input_trigger").click();
    });

    $("#profile_picture_input_trigger").change(function(){
        readURL(this);
    });

    if ($('#register_form').length) {
        $('#register_form').submit(function(e) 
        {
            e.preventDefault();
            var formData = new FormData();
            formData.append('username', $('#username').val());
            formData.append('email', $('#email').val());
            formData.append('password', $('#password').val());
            formData.append('role', $('#role').val());
    
            var profilePicInput = document.getElementById('profile_picture_input_trigger');
            if (profilePicInput.files.length > 0) {
                formData.append('profile_picture_preview', profilePicInput.files[0]);
            }
    
            $.ajax({
                type: 'POST',
                url: registerRoute,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if(response == "true")
                        {
                            window.location.href = '/login';
                        }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    $('#error').text('Error: ' + error);
                }
            });
        });
    
    }

    if ($('#login_form').length) {
    $('#login_form').submit(function(e) {
        e.preventDefault(); 

        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: loginRoute, 
            data: {
                email: email,
                password: password
            },
            success: function(response) {
                if(response == "true")
                    {
                        window.location.href = '/dashboard';
                    }
            },
            error: function(xhr, status, error) {
                console.error(error);
                $('#error').text('Error: ' + error);
            }
        });
    });}

});
