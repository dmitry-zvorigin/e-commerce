<div class="ms-4">
    <hr>
    <div class="d-flex justify-content-between">
        <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
        <p>{{ $comment->created_at }}
    </div>
    @if ($comment->parentComment)
        <p>Кому: {{ $comment->parentComment->user->name }}</p>
    @elseif($comment->commentsAppend)
        <p>Кому: {{ $comment->commentsAppend->user->name }}</p>
    @endif

    <p>{{ $comment->content }}</p>
    <a href="{{ route('review.comment.create', ['review' => $review]) }}" class="btn btn-primary">Ответить</a>
    @if ($comment->commentsAppend) 
        <div>
            @foreach($comment->commentsAppend as $nestedComment)
                @include('review_comment.comments', ['comment' => $nestedComment])
            @endforeach
        </div>
    @endif
</div>