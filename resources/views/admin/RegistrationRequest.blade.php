
@php
    use App\Http\Controllers\AdminController;
    $requests = (new AdminController())->index();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="userDetails">
    @foreach ($requests as $request)
    <div class='user'>
        <img src='{{ $request->profile_picture }}'>
        <p>Username: {{ $request->username }}</p>
        <p>Email: {{ $request->email }}</p>
        <p>Role: {{ $request->role }}</p>
        
        <button class='confirm-btn' data-request-id='{{ $request->id }}' data-role-id='{{ $request->role }}'>Confirm</button>
        <button class='reject-btn' data-request-id='{{ $request->id }}'>Reject</button>
    </div>
    @endforeach
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
