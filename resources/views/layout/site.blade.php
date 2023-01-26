<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('APP_NAME') }}</title>
    @vite(['resources/js/app.js'])
    @vite(['resources/sass/app.js'])
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="container ">
    @include('layout._navbar')
    <div class="container mt-5">
        <div class="row">
            @include('layout._sidebar')
            @include('layout._flash')
        </div>
    </div>
</body>
</html>
