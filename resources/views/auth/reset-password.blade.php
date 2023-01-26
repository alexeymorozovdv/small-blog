@extends('layout.site', ['title' => 'Сбросить пароль'])

@section('content')
    <h1>Reset a password</h1>
    <form method="post" action="{{ route('auth.reset-password') }}" class="w-50">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mt-4">
            <input type="text" class="form-control" name="password"
                   placeholder="Set a new password" required maxlength="255" value="">
        </div>
        <div class="form-group mt-2">
            <input type="text" class="form-control" name="password_confirmation"
                   placeholder="Type it again" required maxlength="255" value="">
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-info text-white">Reset</button>
        </div>
    </form>
@endsection
