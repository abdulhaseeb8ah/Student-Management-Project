@php
    use App\Http\Controllers\SidebarController;
    $sidebarItems = (new SidebarController())->getSidebarItems(session('role'));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/student_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/faculty_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin_styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="header-content">
    @include('partials.header', ['role' => session('role'), 'profilePicUrl' => session('profilePicUrl')])
</div>
<div id="content-container">
    @include('partials.sidebar')
    <div id="content">
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script>
        var sidebarRoute = "{{url('/dashboard')}}";
        var logoutRoute = "{{url('/logout')}}";
        
</script>
</body>
</html>