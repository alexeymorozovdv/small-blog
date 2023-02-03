@extends('layout.app')

@section('body')
    <body>
    <div class="container">
        @include('layout.admin._navbar')
        <div class="row">
            <div class="col">
                @include('layout._flash')

                @yield('content')
            </div>
        </div>
    </div>
    </body>
@endsection
