<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{csrf_token()}}" />
</head>
<body>
    <div class="container">
    <div id="register-side">  
        <h2>Register</h2>
        <form id="register_form" enctype="multipart/form-data">
            <input type="file" name="profile_picture" id="profile_picture_input_trigger" accept="image/*"  style="display: none;">
            <img id="profile_picture_preview" src="{{ asset('profile_pictures/upload.png') }}" alt="Profile Picture" style="max-width: 80px; max-height: 80px; cursor: pointer;"><br>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
                <option value="admin">Admin</option>
            </select><br><br>
            <input type="text" id="username" name="username" placeholder="Username" required><br><br>
            <input type="email" id="email" name="email" placeholder="Email" required><br><br>
            <input type="password" id="password" name="password" placeholder="Password" minlength="8" required><br><br>
            <button id="sign-up-submit" name="sign-up-submit" type="submit">Sign Up</button>
            <h2 style="padding-left:10px; font-size: 12px;">Already registered? <a href="{{ route('login') }}">Login here!</a></h2>
            <div id="error" class="error"></div>
        </form>
    </div>
    </div>
    
    <div id="result" class="result" style="display: none;"></div>
    
    <script>
        var registerRoute = "{{url('/register')}}";
    </script>
    <script src="{{ asset('js/registration.js') }}"></script>
</body>
</html>
