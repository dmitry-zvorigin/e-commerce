<div class="col card mt-4">
    <h3 class="ms-4">Отзывы о {{ $product->name }}</h3>

    <div class="row">
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <p class="display-1">{{ $product->averageRating }}</p>
            <div class="product-rating">
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < round($product->averageRating))
                        <i class="fa fa-star"></i>
                    @else
                        <i class="fa fa-star-o"></i>
                    @endif
                @endfor
            </div>
            <p>{{ $product->reviewCount() }} отзывов</p>
        </div>
    
        <div class="col">
            <div class="bd-example-snippet bd-code-snippet">
                <div class="bd-example m-0 border-0">
                    <div class="row">
                        @foreach ($product->RatingPercentage as $rating)
                            <div class="col-2">
                                <label>{{ $rating['name'] }}</label>
                            </div>
                            <div class="col-10">
                                <div class="progress mb-3" role="progressbar" aria-valuenow="{{ $rating['percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar text-bg-warning" style="width: {{ $rating['percentage'] }}%">{{ $rating['percentage'] }}%</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col d-flex flex-column justify-content-center align-items-center">
            <p>Есть что рассказать?</p>
            <p>Оцените товар, ваш опыт будет полезен</p>
            <a class="btn btn-warning" href="{{ route('review.create', ['product' => $product->slug]) }}">Написать отзыв</a>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="text-center">
            @foreach ($product->galleryReviewsAll->take(5) as $image)
                <img 
                    class="main-img bd-placeholder-img img-thumbnails" 
                    src="{{ asset('gallery_reviews/thumbnails/' . $image->thumbnail) }}" 
                    alt="Описание изображения" width="150" height="150"
                >
            @endforeach
            <a href="#" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Показать все {{ $product->galleryReviewsAll->count() }}</a>
        </div>
    </div>
</div>
