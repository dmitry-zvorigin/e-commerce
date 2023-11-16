@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>

    <div class="container">
        <h1>{{ $product->name }}</h1>
        <hr>

        <div class="card">

            <div class="row">
                <div class="col">
                    <div class="bd-example-snippet bd-code-snippet">
                        <div class="bd-example m-0 border-0">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->images as $image)
                                    <div class="carousel-item">
                                        <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $image->thumbnail) }}" alt="Описание изображения" width="500" height="500">
                                    </div>
                                @endforeach
                                {{-- <div class="carousel-item">
                                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#555" dy=".3em">First slide</text></svg>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5><ya-tr-span data-index="201-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="First slide label" data-translation="Ярлык первого слайда" data-ch="0" data-type="trSpan">Ярлык первого слайда</ya-tr-span></h5>
                                        <p><ya-tr-span data-index="277-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Some representative placeholder content for the first slide." data-translation="Некоторое репрезентативное содержимое-заполнитель для первого слайда." data-ch="0" data-type="trSpan">Некоторое репрезентативное содержимое-заполнитель для первого слайда.</ya-tr-span></p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="400" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#666"></rect><text x="50%" y="50%" fill="#444" dy=".3em">Second slide</text></svg>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5><ya-tr-span data-index="202-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Second slide label" data-translation="Ярлык второго слайда" data-ch="0" data-type="trSpan">Ярлык второго слайда</ya-tr-span></h5>
                                        <p><ya-tr-span data-index="203-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Some representative placeholder content for the second slide." data-translation="Некоторые репрезентативные материалы-заполнители для второго слайда." data-ch="0" data-type="trSpan">Некоторые репрезентативные материалы-заполнители для второго слайда.</ya-tr-span></p>
                                    </div>
                                </div> --}}
                                <div class="carousel-item active">
                                    <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="600" height="600" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#555"></rect><text x="50%" y="50%" fill="#333" dy=".3em">Third slide</text></svg>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"><ya-tr-span data-index="195-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Previous" data-translation="Назад" data-ch="0" data-type="trSpan">Назад</ya-tr-span></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"><ya-tr-span data-index="195-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Next" data-translation=" Далее" data-ch="0" data-type="trSpan"> Далее</ya-tr-span></span>
                            </button>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h3>{{ $product->detail }}</h3>
                    </div>
                    <div class="product-rating d-flex align-items-center">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < round($product->averageRating))
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                        <div class="ms-2">
                            {{ $product->reviewCount() }}
                        </div>
                    </div>

                    <div class="card">
                        <div class="d-flex mb-3 mt-3 justify-content-around">
                            <div>
                                <h3>Цена: {{ $product->price }}</h3>
                            </div>
                            <div class="d-flex">
                                <div class="mx-4">
                                    <form method="post" action="">
                                        @csrf
                                        <button class="btn btn-success" type="submit">В избранное</button>
                                    </form>
                                </div>
                                <div>
                                    <form method="post" action="">
                                        {{-- {{ route('cart.addToCart') }} --}}
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn btn-success" type="submit">Купить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="d-flex align-content-start justify-content-around flex-wrap">
                @foreach ($product->images as $image)
                    <div class="card-body">
                        <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $image->thumbnail) }}" alt="Описание изображения" width="200" height="200">
                    </div>
                @endforeach
            </div> --}}

        <div class="col">
            <div class="card">
                <h3 class="ms-4">Характеристики</h3>
                <div class="card-body">
                    @foreach ($product->characteristics as $group => $characteristics)
                    <ul>
                        <h4>{{ $characteristics->first()->group->name }}</h4>
                        @foreach ($characteristics as $characteristic)
                            <ol>
                                <div class="d-flex justify-content-between">
                                <p>{{ $characteristic->attribute->attribute_name }} => {{ $characteristic->value->value }}</p>
                                </div>
                            </ol>
                        @endforeach
                    </ul>

                    @endforeach
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <h3 class="ms-4">Описание</h3>
                <div class="card-body">
                    <p class="card-text">{{ $product->description }}</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
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

                <hr>

                <div>
                    <form method="get" action="{{ route('catalog.product', ['category' => $category, 'product' => $product->slug]) }}">
                        <div class="d-flex">

                            <input name="search" type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Поиск</button>
                            <select class="form-select" id="sorting-select" name="sorting">
                                <option value="">-- Выберите сортировку --</option>
                                <option value="sortingDate" @selected(request('sorting') =='sortingDate')>По дате</option>
                                <option value="sortingRating" @selected(request('sorting') == 'sortingRating')>По рейтингу</option>
                                <option value="sortingPopularity" @selected(request('sorting') == 'sortingPopularity')>По популярности</option>
                                <option value="sortingEdit" @selected(request('sorting') == 'sortingEdit')>По дате изменения</option>
                            </select>
                        </div>

                        <div class="d-flex mt-4">
                            <div class="form-check ms-4">
                                {{-- <input name="rating_5" class="form-check-input" type="checkbox" value="" id="flexCheckChecked"> --}}
                                <input name="ratings[]" class="form-check-input" type="checkbox" value="5" id="flexCheckChecked5" @checked(in_array(5, request('ratings', [])))>
                                <label class="form-check-label" for="flexCheckChecked">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check ms-4">
                                <input name="ratings[]" class="form-check-input" type="checkbox" value="4" id="flexCheckChecked4" @checked(in_array(4, request('ratings', [])))>
                                <label class="form-check-label" for="flexCheckChecked">
                                    </i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check ms-4">
                                <input name="ratings[]" class="form-check-input" type="checkbox" value="3" id="flexCheckChecked3" @checked(in_array(3, request('ratings', [])))>
                                <label class="form-check-label" for="flexCheckChecked">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check ms-4">
                                <input name="ratings[]" class="form-check-input" type="checkbox" value="2" id="flexCheckChecked2" @checked(in_array(2, request('ratings', [])))>
                                <label class="form-check-label" for="flexCheckChecked">
                                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                </label>
                            </div>
                            <div class="form-check ms-4">
                                <input name="ratings[]" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked1" @checked(in_array(1, request('ratings', [])))>
                                <label class="form-check-label" for="flexCheckChecked">
                                    <i class="fa fa-star"></i>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>

                <div class="card-body">
                    @foreach ($product->reviews as $review)
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
                            <h4>Достоинства</h4>
                            <p>{{ $review->dignities }}</p>
                        @endif

                        @if (!empty($review->disadvantages))
                            <h4>Недостатки</h4>
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
                        <div class="d-flex justify-content-end">
                            <i class="fa fa-thumbs-o-up fa-2x" aria-hidden="true"></i>
                            <h4 class="ms-4">{{ $review->likes - $review->dislikes }}</h4>
                            <i class="fa fa-thumbs-o-down ms-4 fa-2x" aria-hidden="true"></i>
                        </div>


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
                    {{ $product->reviews->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

