@extends('layout.site', ['title' => 'Page Not Found'])

@section('content')
    <h1>Page Not Found</h1>
    <img src="{{ asset('img/404.png') }}" alt="" class="img-fluid">
    <p class="mt-3 mb-0">The requested page wasn't found</p>
@endsection
