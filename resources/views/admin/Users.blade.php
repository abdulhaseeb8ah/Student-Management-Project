
@php
    use App\Http\Controllers\AdminController;
    $requests = (new AdminController())->showUsersStatus();
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="userDetails">
    @foreach ($requests as $request)
    <div class='user'>
        <img src='{{ $request->profile_picture }}'>
        <p>Username: {{ $request->username }}</p>
        <p>Email: {{ $request->email }}</p>
        <p>Role: {{ $request->role }}</p>
        @if($request->status == 'block')
            <button class='unblock-btn' data-request-id='{{ $request->id }}'>Unblock</button>
        @elseif(($request->status != 'block'))
            <button class='block-btn' data-request-id='{{ $request->id }}' data-role-id='{{ $request->role }}'>Block</button>
        @endif
    </div>
    @endforeach
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
