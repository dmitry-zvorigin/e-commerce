<div class="card col mt-4">
    @foreach ($reviews as $review)
        <div class="col-md-11 mt-4 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fa fa-user-o" aria-hidden="true"></i>{{ $review->user->name }}
                    </div>
                    <small class="text-muted">{{ $review->created_at }}</small>
                </div>
                <div class="card-body">
                    <div class="product-rating mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                    </div>
                    
                    @if (!empty($review->dignities))
                        <h6 class="card-subtitle mb-2 text-muted">Достоинства:</h6>
                        <p class="card-text">{{ $review->dignities }}</p>
                    @endif
        
                    @if (!empty($review->disadvantages))
                        <h6 class="card-subtitle mb-2 text-muted">Недостатки:</h6>
                        <p class="card-text">{{ $review->disadvantages }}</p>
                    @endif
        
                    @if (!empty($review->comment))
                        <h6 class="card-subtitle mb-2 text-muted">Комментарий:</h6>
                        <p class="card-text">{{ $review->comment }}</p>
                    @endif

                    @if (!empty($review->images))
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Фотографии:</h6>
                        @foreach ($review->images as $image)
                            <img 
                                id="thumbnail-image-review" 
                                class="main-img bd-placeholder-img img-thumbnails" 
                                src="{{ asset('gallery_reviews/thumbnails/' . $image->thumbnail) }}" 
                                alt="Описание изображения" width="100" height="100"
                            >
                        @endforeach
                    </div>
                    @endif

                </div>
                <div class="d-flex justify-content-between align-items-center mb-4 me-4">
                    <div class="ms-4">
                        <a href="">Комментарии (10)</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="button" class="btn btn-outline-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                    <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"></path>
                                </svg>
                                <span class="visually-hidden"><ya-tr-span data-index="21-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Button" data-translation="Кнопка" data-ch="0" data-type="trSpan">Кнопка</ya-tr-span></span>
                            </button>
                        </div>
                        <div class="me-2 ms-2">
                            <h6 class="card-subtitle text-muted">{{ $review->likes - $review->dislikes }}</h6>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                    <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"></path>
                                </svg>
                                <span class="visually-hidden"><ya-tr-span data-index="20-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Button" data-translation="Кнопка" data-ch="0" data-type="trSpan">Кнопка</ya-tr-span></span>
                            </button>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    @endforeach
    <div class="col mt-4 d-flex flex-column justify-content-center align-items-center">
        {{ $reviews->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
    </div>
</div>



<div class="card-body">
    <div class="card mt-4">
        @foreach ($reviews as $review)
            <div class="d-flex justify-content-between">
                <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $review->user->name }}</p>
                <p>{{ $review->created_at }}
            </div>
            <div class="product-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <i class="fa fa-star"></i>
                    @else
                        <i class="fa fa-star-o"></i>
                    @endif
                @endfor
            </div>

            @if (!empty($review->dignities))
                <h3>Достоинства</h3>
                <p>{{ $review->dignities }}</p>
            @endif

            @if (!empty($review->disadvantages))
                <h3>Недостатки</h3>
                <p>{{ $review->disadvantages }}</p>
            @endif

            @if (!empty($review->comment))
                <h4>Комментарий</h4>
                <p>{{ $review->comment }}</p>
            @endif

            {{-- TODO --}}
            @if (!empty($review->dignities))
                <h4>Фотографии</h4>
            @endif

            <div class="d-flex flex-column mb-4">
                <form action="{{ route('review.comment.store', ['review' => $review]) }}" method="post" class="d-flex flex-column">
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

            <div class="d-flex justify-content-end">
                <i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i>
                <h4 class="ms-4">{{ $review->likes - $review->dislikes }}</h4>
                <i class="fa fa-thumbs-o-down ms-4 fa-2x" aria-hidden="true"></i>
            </div>

            {{-- <a href="{{ route('review.comment.create', ['review' => $review]) }}" class="btn btn-primary">Ответить</a> --}}
            
            @foreach ($review->comments()->whereNull('parent_comment_id')->get() as $comment) 
                <div class="comment ms-4">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><i class="fa fa-user-o" aria-hidden="true"></i> {{ $comment->user->name }}</p>
                        <p>{{ $comment->created_at }}
                    </div>
                    <p>Кому: {{ $comment->review->user->name }}</p>
                    <p>{{ $comment->content }}</p>
                    {{-- <a href="{{ route('review.comment.reply.create', ['review' => $comment->review, 'comment' => $comment]) }}" class="btn btn-primary">Ответить</a> --}}
                    
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

                    @if($comment->commentsChildren->count() > 0)
                        @include('review_comment.comments', ['comments' => $comment->commentsChildren])
                    @endif
                </div>
                

            @endforeach
            
            <hr>
        @endforeach

    </div>
    <div class="col d-flex flex-column justify-content-center align-items-center">
        {{ $reviews->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
    </div>
</div>
 