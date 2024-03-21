@extends('layout.app')

@section('content')
    {{ Auth::user()->nama }}
    <a href="#" onclick="event.preventDefault(); Logout();">
        Logout
    </a>
@endsection