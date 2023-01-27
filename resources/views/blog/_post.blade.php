<div class="card mb-4">
    <div class="card-header">
        <h2>{{ $post->name }}</h2>
    </div>
    <div class="card-body">
        <img src="https://via.placeholder.com/1000x300" alt="" class="img-fluid">
        <p class="mt-3 mb-0">{{ $post->excerpt }}</p>
    </div>
    <div class="card-footer">
        <div class="d-flex flex-row justify-content-between mt-2">
            <div>
                Author:
                <a href="{{ route('blog.author', ['user' => $post->author->id]) }}">
                    {{ $post->author->name }}
                </a>
                <br>
                Date: {{ $post->created_at }}
            </div>
            <div class="justify-content-end">
                <a href="{{ route('blog.post', ['post' => $post->slug]) }}"
                   class="btn btn-dark">Read</a>
            </div>
        </div>
    </div>
    @if ($post->tags->count())
        <div class="card-footer">
            Tags:
            @foreach($post->tags as $tag)
                @php $comma = $loop->last ? '' : ' • ' @endphp
                <a class="btn btn-primary mb-2 mt-2" href="{{ route('blog.tag', ['tag' => $tag->slug]) }}">
                    #{{ $tag->name }}
                </a>
                {{ $comma }}
            @endforeach
        </div>
    @endif
</div>
