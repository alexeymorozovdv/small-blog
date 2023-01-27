@extends('layout.site', ['title' => $category->name])

@section('content')
    <h1 class="mb-3">Category: {{ $category->name }}</h1>
    @foreach ($posts as $post)
        @include('blog._post', ['post' => $post])
    @endforeach
    {{ $posts->links() }}
@endsection
