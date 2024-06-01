@php
    use App\Http\Controllers\SidebarController;
    $sidebarItems = (new SidebarController())->getSidebarItems(session('role'));
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="main-logo">
    <a href="dashboard.php"><img src="{{ asset('profile_pictures/main_logo.png') }}" alt="Logo"></a>
    <div class="dropdown">
    <img id="dashboard-picture" src="{{ asset($profilePicUrl) }}" alt="Profile Picture" style="height: 50px; width: 50px;">

        <div class="dropdown-content"> 
            <a id="logout-btn" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
</div>


