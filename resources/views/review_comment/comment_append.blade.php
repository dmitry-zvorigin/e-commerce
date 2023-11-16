@foreach($comments as $comment)
    <div>
        <p>{{ $comment->content }}</p>
        <p>{{ $comment->user->name }}</p>
        <a href="{{ route('review.comment.create', ['review' => $review]) }}" class="btn btn-primary">Ответить</a>
    </div>
@endforeach