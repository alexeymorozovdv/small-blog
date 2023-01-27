@extends('layout.site', ['title' => 'Author\'s posts: ' . $user->name])

@section('content')
    <h1 class="mb-3">Author's posts: {{ $user->name }}</h1>
    @foreach ($posts as $post)
        @include('blog._post', ['post' => $post])
    @endforeach
    {{ $posts->links() }}
@endsection
