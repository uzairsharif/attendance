@extends('attendance::layouts.app')

@section('content')
<div class="container text-center">
    <div class="alert alert-danger">
        <h2>Account Not Approved</h2>
        <p>Your account is currently inactive or has not been approved by the administrator.</p>
        <p>Please contact support for further assistance.</p>

        <a href="{{ route('login') }}" class="btn btn-primary">Back to Login</a>
    </div>
</div>
@endsection
