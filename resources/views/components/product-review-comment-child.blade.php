<div class="col mt-4 ms-4 mb-4">
    @foreach ($commentsChild as $commentChild)
        <div class="col-md-11 mt-4 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fa fa-user-o" aria-hidden="true"></i>{{ $commentChild->user->name }}
                    </div>
                    <small class="text-muted">{{ $commentChild->created_at }}</small>
                </div>
                <div class="card-header d-flex justify-content-between">
                    <div>
                        Кому: {{ $commentChild->commentReply->user->name ?? $commentChild->commentParent->user->name }}
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">{{ $commentChild->content }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4 me-4">
                    <div class="ms-4">
                        <button type="button" class="form-comment-child-btn btn btn-outline-secondary" data-form-comment-child-id="{{ $commentChild->id}}">Ответить</button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="button" class="btn btn-outline-secondary">
                                <i class="bi bi-hand-thumbs-up"></i>
                                <span class="visually-hidden">
                                    <ya-tr-span>Кнопка</ya-tr-span>
                                </span>
                            </button>
                        </div>
                        <div class="me-2 ms-2">
                            <h6 class="card-subtitle text-muted">{{ $commentChild->likes - $commentChild->dislikes }}</h6>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-secondary">
                                <i class="bi bi-hand-thumbs-down"></i>
                                <span class="visually-hidden">
                                    <ya-tr-span>Кнопка</ya-tr-span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div> 
                <div id="block-comment-child-form{{ $commentChild->id }}" class="" style="display: none">
                    <div class="d-flex flex-column mb-4 me-4">
                        <form action="{{ route('review.comment.reply.store') }}" method="post" class="d-flex flex-column">
                            @csrf
                            <input type="hidden" name="reply_comment_id" value="{{ $commentChild->id }}">
                            <input type="hidden" name="review_id" value="{{ $commentParent->review_id}}">
                            <input type="hidden" name="parent_comment_id" value="{{ $commentParent->id }}"> 
                            <div class="d-flex justify-content-end">
                                <textarea class="form-control mb-2" name="comment" id="comment" rows="2" style="width: 50%;" placeholder="Написать ответ...">{{ old('comment') }}</textarea>
                            </div>
                            @error('comment')
                                <p><span class="text-danger">{{ $message }}</span></p>
                            @enderror
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Ответить</button>
                            </div>
                        </form>
                    </div>  
                </div>   
            </div>
        </div>
    @endforeach
</div>