@extends('layouts.app')
@section('content')
{{-- <div class="container">
    <h1>Детали продукта</h1>
    <h3><a href="{{ route('products.index') }}">На главную</a></h3>
    <table>
        <thead>
            <tr>
                <th>Название продукта</th>
                <th>Цена</th>
                <th>Цвет</th>
                <th>Дата публикации</th>
                <th>Дата изменения</th>
                <th>Действия</th> <!-- Новый заголовок для столбца с действиями -->
                <!-- Добавьте заголовки для других столбцов, если необходимо -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->color }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <!-- Кнопка для редактирования продукта -->
                    <a href="{{ route('products.edit', ['product' => $product->id]) }}">Редактировать</a>

                    <!-- Форма для удаления продукта -->
                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
                    </form>
                    <form method="post" action="{{ route('cart.addToCart') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit">Добавить в корзину</button>
                    </form>
                </td>
                <!-- Добавьте ячейки для других столбцов, если необходимо -->
            </tr>
        </tbody>
    </table>
</div> --}}

{{-- <div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- Название продукта -->
            <h2>{{ $product->name }}</h2>

            <!-- Фотографии в миниатюрах (замените на цикл, если есть несколько фотографий) -->
            <div class="mb-4">
                <img src="{{ $product->thumbnail1 }}" alt="Фотография 1" class="img-thumbnail">
                <img src="{{ $product->thumbnail2 }}" alt="Фотография 2" class="img-thumbnail">
                <img src="{{ $product->thumbnail3 }}" alt="Фотография 3" class="img-thumbnail">
            </div>

            <!-- Цена -->
            <h3>Цена: ${{ $product->price }}</h3>
        </div>
        <div class="col-md-6">
            <!-- Характеристики -->
            <h3>Характеристики:</h3>
            <ul>
                <li>Характеристика 1: {{ $product->feature1 }}</li>
                <li>Характеристика 2: {{ $product->feature2 }}</li>
                <!-- Добавьте другие характеристики по мере необходимости -->
            </ul>
        </div>
    </div>

    <!-- Описание -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Описание:</h3>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div> --}}


<div class="container">
    <div class="row">
        <div class="col h-100">
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img src="{{ asset('img/product07.png') }}" alt="Ваше изображение">
                    </div>
                    <div class="carousel-item active">
                        <img src="{{ asset('img/product07.png') }}" alt="Ваше изображение">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('img/product07.png') }}" alt="Ваше изображение">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><ya-tr-span data-index="8-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Previous" data-translation="Назад" data-ch="0" data-type="trSpan">Назад</ya-tr-span></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><ya-tr-span data-index="8-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Next" data-translation="Далее" data-ch="0" data-type="trSpan">Далее</ya-tr-span></span>
                </button>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <h1>{{ $product->name }}</h1>
            </div>
            <div class="rating col">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
            </div>
            <div class="row">
                <h3>Description</h3>
            </div>
            <div class="row">
                <h1>Price: {{ $product->price }}</h1>
            </div>
            <div class="row">
                <h6>Date: {{ $product->updated_at }}</h6>
            </div>
            <div class="row">
                <hr>
                <div class="col">
                    <div class="qty-plus-minus">
                        <input type="number" name="ec_qtybtn" value="1">
                    </div>
                </div>
                <div class="col">
                    <form method="post" action="{{ route('cart.addToCart') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="btn btn-primary" type="submit">Добавить в корзину</button>
                    </form>
                </div>
                <div class="col">
                    icon
                </div>
                <div class="col">
                    icon
                </div>
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <hr>
            <h1>Detail</h1>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the
                1500s, when an unknown printer took a galley of type and scrambled it to
                make a type specimen book. It has survived not only five centuries, but also
                the leap into electronic typesetting, remaining essentially unchanged.
            </p>
            <hr>
        </div>
        <div class="row-md-6">
            <h1>More Information</h1>
            <ul>
                <li><span>Weight</span> 1000 g</li>
                <li><span>Dimensions</span> 35 × 30 × 7 cm</li>
                <li><span>Color</span> Black, Pink, Red, White</li>
            </ul>
        </div>
        <div class="row">
            <hr>
            <h1>Reviews</h1>
            <hr>
            <div class="row">
                <div class="col">
                    Image
                </div>
                <div class="col">
                    <h3>Jeny Doe</h3>
                    <div class="rating col">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <h5>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a
                        type specimen.
                    </h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    Image
                </div>
                <div class="col">
                    <h3>Jeny Doe</h3>
                    <div class="rating col">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <h5>Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's
                        standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it to make a
                        type specimen.
                    </h5>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>

@endsection
