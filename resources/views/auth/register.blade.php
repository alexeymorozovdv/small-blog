@extends('layout.site', ['title' => 'Registration'])

@section('content')
    <h1>Registration</h1>
    <form method="post" action="{{ route('auth.store') }}" class="w-75">
        @csrf
        <div class="form-group mt-4">
            <input type="text" class="form-control" name="name" placeholder="Name"
                   required maxlength="255" value="{{ old('name') ?? '' }}">
        </div>
        <div class="form-group mt-2">
            <input type="email" class="form-control" name="email" placeholder="Email"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group mt-2">
            <input type="password" class="form-control" name="password" placeholder="Password"
                   required maxlength="255" value="">
        </div>
        <div class="form-group mt-2">
            <input type="password" class="form-control" name="password_confirmation"
                   placeholder="Password confirmation" required maxlength="255" value="">
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-info text-white">Register</button>
        </div>
    </form>
@endsection
