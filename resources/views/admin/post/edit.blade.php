@extends('layout.admin.main', ['title' => 'Edit a post'])

@section('content')
    <h1>Edit a post</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.post.update', ['post' => $post->id]) }}">
        @method('PUT')
        @include('admin.part._form')
    </form>
@endsection
