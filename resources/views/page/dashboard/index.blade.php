@extends('layout.app')

@section('content')
    {{ Auth::user()->nama }}
@endsection