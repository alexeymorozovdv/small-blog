@extends('layout.site', ['title' => 'Вход в личный кабинет'])

@section('content')
    <h1>Login</h1>
    <form method="post" action="{{ route('auth.auth') }}" class="w-75">
        @csrf
        <div class="form-group mt-4">
            <input type="email" class="form-control" name="email" placeholder="Email"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group mt-2">
            <input type="text" class="form-control" name="password" placeholder="Password"
                   required maxlength="255" value="">
        </div>
        <div class="form-group form-check mt-3">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-info text-white">Login</button>
            </div>
            <div class="mt-3">
                <a href="{{ route('auth.forgot-form') }}">Forgot a password?</a>
            </div>
        </div>
    </form>
@endsection
