@extends('layout.site', ['title' => 'All posts'])

@section('content')
    <h1 class="mb-3">All posts:</h1>
    @foreach ($posts as $post)
        @include('blog._post', ['post' => $post])
    @endforeach
    {{ $posts->links() }}
@endsection
