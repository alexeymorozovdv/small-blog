@extends('layout.app')

@section('body')
    <body class="container min-vh-100 d-flex flex-column">
    @include('layout._navbar')
    <div class="container mt-5 flex-grow-1 flex-shrink-1">
        <div class="row">
            @include('layout.sidebar._sidebar')
            <div class="col-md-9">
                @include('layout._flash')
                @yield('content')
            </div>
        </div>
    </div>
    @include('layout._footer')
    </body>
@endsection
