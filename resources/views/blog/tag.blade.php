@extends('layout.site', ['title' => 'Posts with the tag:' . $tag->name])

@section('content')
    <h1 class="mb-3">Posts with the tag: #{{ $tag->name }}</h1>
    @foreach ($posts as $post)
        @include('blog._post', ['post' => $post])
    @endforeach
    {{ $posts->links() }}
@endsection
