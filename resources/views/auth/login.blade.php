<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Update the path accordingly -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}" />
</head>
<body>
<div class="container">
    <div id="login-side">
            <h2>Login</h2>
            <form id="login_form" enctype="multipart/form-data">
           
                <div id="error" class="error"></div>
                <input type="email" name="email" id="email" placeholder="Email"><br>
                <input type="password" name="password" id="password" placeholder="Password"><br>
                <button type="submit">Login</button>
                <h2 style="padding-left:10px; font-size: 12px;">Not registered yet? <a href="{{ route('register') }}">Sign up here!</a></h2>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('js/registration.js') }}"></script>
    <script>
        var loginRoute = "{{url('/login')}}";
    </script>
</body>
</html>
