{{-- <div class="ms-4">
    <hr>
    <div class="d-flex justify-content-between">
        <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
        <p>{{ $comment->created_at }}
    </div>
    @if ($comment->review)
        <p>Кому: {{ $comment->review->user->name }}</p>
    @elseif($comment->commentAppend)
        <p>Кому: {{ $comment->commentAppend->user->name }}</p>
    @endif

    <p>{{ $comment->content }}</p>
    <a href="{{ route('review.comment.reply.create', ['review' => $comment->review, 'comment' => $comment]) }}" class="btn btn-primary">Ответить</a>
    @if ($comment->commentsAppend) 
        <div>
            @foreach($comment->commentsAppend as $nestedComment)
                @include('review_comment.comments', ['comment' => $nestedComment])
            @endforeach
        </div>
    @endif
</div> --}}

{{-- <div class="ms-4">
    <hr>
    <div class="d-flex justify-content-between">
        <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
        <p>{{ $comment->created_at }}
    </div>
    <p>Кому: {{ $comment->review->user->name }}</p>
    <p>{{ $comment->content }}</p>

    <a href="{{ route('review.comment.reply.create', ['review' => $comment->review, 'comment' => $comment]) }}" class="btn btn-primary">Ответить</a>

    @foreach ($comment->commentsChildren as $reply)
        <div class="reply ms-4">
        <hr>
            <div class="d-flex justify-content-between">
                <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $reply->user->name }}</p>
                <p>{{ $comment->created_at }}
            </div>
            <p>Кому: {{ $comment->user->name }}</p>
            <p>{{ $reply->content }}</p>

            <a href="{{ route('review.comment.reply.create', ['comment' => $reply, 'review' => $comment->review]) }}" class="btn btn-primary">Ответить</a>
            <!-- Повторяем для ответов на ответы -->
            @if ($reply->commentAppend)
                @foreach ($reply->commentAppend as $replyToReply)
                    <div class="reply-to-reply">
                        <div class="d-flex justify-content-between">
                            <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $replyToReply->user->name }}</p>
                            <p>{{ $replyToReply->created_at }}
                        </div>
                        <p>name: {{ $replyToReply->user->name }}</p>
                        <p>Кому: {{ $reply->user->name }}</p>

                        <a href="{{ route('review.comment.reply.create', ['comment' => $replyToReply]) }}" class="btn btn-primary">Ответить</a>
                    </div>
                @endforeach
            @endif
        </div>
    @endforeach
</div> --}}

{{-- <div class="ms-4">
    <hr>
    <div class="d-flex justify-content-between">
        <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
        <p>{{ $comment->created_at }}
    </div>

    <p>Кому: {{ $comment->review->user->name }}</p>
    <p>{{ $comment->content }}</p>

    <a href="{{ route('review.comment.reply.create', ['review' => $comment->review, 'comment' => $comment]) }}" class="btn btn-primary">Ответить</a>

    @if ($comment->childrenComments)
        <div class="children-comments">
            @foreach ($comment->childrenComments as $childComment)
                @include('comments', ['comment' => $childComment])
            @endforeach
        </div>
    @endif
</div> --}}

@foreach($comments as $comment)
    <div class="reply ms-4">
        <hr>
        <div class="d-flex justify-content-between">
            <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
            <p>{{ $comment->created_at }}
        </div>

        <p>Кому: {{ $comment->commentParent->user->name }}</p>
        <p>{{ $comment->content }}</p>

        <div class="d-flex flex-column">
            <form action="{{ route('review.comment.reply.store', ['review' => $comment->review, 'comment' => $comment]) }}" method="post" class="d-flex flex-column">
                @csrf
                <div class="d-flex justify-content-end">
                    <textarea class="form-control mb-2" name="comment" id="comment" rows="2" style="width: 50%;" placeholder="Написать комментарий...">{{ old('comment') }}</textarea>
                </div>
                @error('comment')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Ответить</button>
                </div>
            </form>
        </div>
        {{-- <a href="{{ route('review.comment.reply.create', ['review' => $comment->review, 'comment' => $comment]) }}" class="btn btn-primary">Ответить</a> --}}


    </div>
        @if($comment->commentsChildren->count() > 0) 
            <div class="nested-comments ms-4">
                @include('review_comment.comments', ['comments' => $comment->commentsChildren])
            </div>
        @endif
@endforeach