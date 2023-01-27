<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    @vite(['resources/js/app.js'])
    @vite(['resources/sass/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    @yield('body')
</html>
