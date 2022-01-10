@extends('index')

@section('content)

<form action="{{ route('verificationRequest') }}" method="post">
    <button type="submit">Request a new link</button>
</form>

@endsection