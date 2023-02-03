@extends('layout.admin.main', ['title' => 'Все посты блога'])

@section('content')
    <h1>All Posts</h1>
    @if ($roots->count())
        <ul>
            @foreach ($roots as $root)
                <li>
                    <a href="{{ route('admin.post.category', ['category' => $root->id]) }}">
                        {{ $root->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    @if ($posts->count())
        <table class="table table-bordered">
            <tr>
                <th style="width: 10%">Date</th>
                <th style="width: 40%">Name</th>
                <th style="width: 20%">Author</th>
                <th style="width: 20%">Allows publication</th>
                <th><i class="fas fa-eye"></i></th>
                <th><i class="fas fa-toggle-on"></i></th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->author->name }}</td>
                    <td>
                        @if ($post->editor)
                            {{ $post->editor->name }}
                        @endif
                    </td>
                    <td>
                        @perm('manage-posts')
                            <a href="{{ route('admin.post.show', ['post' => $post->id]) }}"
                               title="Preview">
                                <i class="far fa-eye"></i>
                            </a>
                        @endperm
                    </td>
                    <td>
                        @perm('publish-post')
                        @if ($post->isVisible())
                            <a href="{{ route('admin.post.disable', ['post' => $post->id]) }}"
                               title="Discard publication">
                                <i class="far fa-toggle-on"></i>
                            </a>
                        @else
                            <a href="{{ route('admin.post.enable', ['post' => $post->id]) }}"
                               title="Allow publication">
                                <i class="far fa-toggle-off"></i>
                            </a>
                        @endif
                        @endperm
                    </td>
                    <td>
                        @perm('edit-post')
                        <a href="{{ route('admin.post.edit', ['post' => $post->id]) }}"
                           title="Edit publication">
                            <i class="far fa-edit"></i>
                        </a>
                        @endperm
                    </td>
                    <td>
                        @perm('delete-post')
                        <form action="{{ route('admin.post.destroy', ['post' => $post->id]) }}"
                              method="post" onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('DELETE')
                            <button title="Delete publication" type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                        @endperm
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $posts->links() }}
    @endif
@endsection
