@extends('layout')

@section('content')
    <h2>{{ 'You logged in as ' . session('role') }}</h2>
    <script>
    var role = @json($role);
</script>
@endsection