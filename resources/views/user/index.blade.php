@extends('layout.site', ['title' => 'Личный кабинет'])

@section('content')
    <h1>Profile</h1>
    <p>Hello, {{ auth()->user()->name }}!</p>
@endsection
