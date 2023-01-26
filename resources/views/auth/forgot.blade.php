@extends('layout.site', ['title' => 'Restore a password'])

@section('content')
    <h1>Restore a password</h1>
    <form method="post" action="{{ route('auth.forgot-mail') }}" class="w-50">
        @csrf
        <div class="form-group mt-4">
            <input type="email" class="form-control" name="email" placeholder="Email"
                   required maxlength="255" value="{{ old('email') ?? '' }}">
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-info text-white">Restore</button>
        </div>
    </form>
@endsection
