<div class="col mt-4 ms-4 mb-4">
    @foreach ($comments as $comment)
        <div class="col-md-11 mt-4 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fa fa-user-o" aria-hidden="true"></i>{{ $comment->user->name }}
                    </div>
                    <small class="text-muted">{{ $comment->created_at }}</small>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4 me-4">
                    <div class="ms-4">
                        
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
                            <h6 class="card-subtitle text-muted">{{ $comment->likes - $comment->dislikes }}</h6>
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
                <div class="d-flex justify-content-between align-items-center mb-4 me-4 ms-4">
                    <button type="button" class="form-comment-parent-btn btn btn-outline-secondary" data-form-comment-parent-id="{{ $comment->id}}">Ответить</button>
                    @if($comment->commentsChildren->count() > 0)
                        <button 
                            type="button" 
                            class="load-comments-child-btn btn btn-outline-secondary" 
                            data-load-comments-parent-id="{{ $comment->id }}"
                            data-comment-child-count="{{ $comment->commentsChildren->count() }}"
                            >
                                Показать ответы({{ $comment->commentsChildren->count() }})
                        </button>
                    @endif
                    
                </div>
                <div id="block-comment-parent-form{{ $comment->id }}" class="" style="display: none">
                    <div class="d-flex flex-column mb-4 me-4">
                        <form action="{{ route('review.comment.append.store') }}" method="post" class="d-flex flex-column">
                            @csrf
                            <input type="hidden" name="review_id" value="{{ $comment->review_id}}">
                            <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}"> 
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
                </div>
            </div>
            <div class="block-comments-child-{{ $comment->id }}"  style="display: none"></div>    
        </div>
    @endforeach
</div>