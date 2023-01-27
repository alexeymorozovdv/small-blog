<h3 id="comment-list">All comments</h3>
@if ($comments->count())
    @foreach ($comments as $comment)
        <div class="card mb-3" id="comment-{{ $comment->id }}">
            <div class="card-header p-2">
                {{ $comment->author->name }}
            </div>
            <div class="card-body p-2">
                {{ $comment->content }}
            </div>
            <div class="card-footer p-2">
                {{ $comment->created_at }}
            </div>
        </div>
    @endforeach
    {{ $comments->fragment('comment-list')->links() }}
@else
    <p>There is no comments yet...</p>
@endif
