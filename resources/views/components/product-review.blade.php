<div class="product-reviews-container card col mt-4">
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

                    @if ($review->images->isNotEmpty())
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
                        <button type="button" class="load-comments-btn btn btn-outline-secondary" data-review-id="{{ $review->id }}">
                            {{ $review->commentsParentCount() == 0 ? 'Комментировать' : 'Комментарии (' . $review->commentsParentCount() . ')' }}
                            <i class="bi bi-chevron-right"></i>
                        </button>
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
                            <h6 class="card-subtitle text-muted">{{ $review->likes - $review->dislikes }}</h6>
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
                <div id="comments-form-{{ $review->id }}" class="mb-4 me-4" style="display: none">
                    <div class="d-flex flex-column">
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

                </div>  
                <div id="comments-block-{{ $review->id }}" class="comments-block" style="display: none"></div>
              
            </div>
        </div>
    @endforeach
    <div class="col mt-4 d-flex flex-column justify-content-center align-items-center">
        {{ $reviews->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Обработчик клика на кнопке "Загрузить комментарии"
        $('.load-comments-btn').on('click', function() {
            const reviewId = $(this).data('review-id'); // Получаем ID отзыва из кнопки
            const commentsBlock = $('#comments-block-' + reviewId); // Находим блок комментарев
            const commentsForm = $('#comments-form-' + reviewId); // Находим блок формы

            const buttonIcon = $(this).find('i');

            if (commentsBlock.is(':visible')) {
                commentsBlock.hide();
                commentsForm.hide();

                buttonIcon.removeClass('bi-chevron-down').addClass('bi-chevron-right');
            } else {
                // Отправляем AJAX-запрос на сервер для получения комментариев
                $.ajax({
                    type: 'GET',
                    url: '/load-comments/' + reviewId, // Маршрут для получения комментариев
                    success: function(response) {
                        // Добавляем полученные комментарии в блок под отзывом
                        commentsBlock.html(response);

                        commentsBlock.show();
                        commentsForm.show();
                        
                        buttonIcon.removeClass('bi-chevron-right').addClass('bi-chevron-down');

                    },
                    error: function() {
                        alert('Произошла ошибка при загрузке комментариев');
                    }
                });
            }
        });

        $('.product-reviews-container').on('click', '.load-comments-child-btn', function() {
            const commentParentId = $(this).data('load-comments-parent-id');
            const commentsChildBlock = $('.block-comments-child-' + commentParentId);
            const commentsChildCount = $(this).data('comment-child-count');
            
            // Сохраняем контекст в переменной для дальнейшего использования внутри success и error
            const $this = $(this);


            if (commentsChildBlock.is(':visible')) {
                commentsChildBlock.hide();
                $this.text('Показать ответы (' + commentsChildCount + ')');
            } else {
                // Загрузка количества ответов через AJAX-запрос
                $.ajax({
                    type: 'GET',
                    url: '/load-comments-child/' + commentParentId,
                    success: function(response) {
                        commentsChildBlock.html(response).show();
                        $this.text('Скрыть ответы (' + commentsChildCount + ')');
                    },
                    error: function() {
                        alert('Произошла ошибка при загрузке комментариев');
                    }
                });
            }
        });

        // Обработчик клика на кнопке "Ответить"
        $('.product-reviews-container').on('click', '.form-comment-parent-btn', function() {
            const commentId = $(this).data('form-comment-parent-id');
            const commentsForm = $(`#block-comment-parent-form${commentId}`);

            // Скрываем все другие блоки форм, кроме текущего
            $(`[id^="block-comment-parent-form"]`).not(commentsForm).hide();

            // Показываем или скрываем текущую форму в зависимости от её текущего состояния
            commentsForm.toggle();
        });


        $('.product-reviews-container').on('click', '.form-comment-child-btn', function() {
            const commentId = $(this).data('form-comment-child-id');
            const commentForm = $('#block-comment-child-form' + commentId);

            // Скрываем все другие блоки форм, кроме текущего
            $('[id^="block-comment-child-form"]').not(commentForm).hide();

            // Показываем или скрываем текущую форму в зависимости от её текущего состояния
            commentForm.toggle();
        });

    });
</script>