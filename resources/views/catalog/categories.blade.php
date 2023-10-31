@extends('layouts.app')
@section('content')


<div id="products" class="container">
    <div class="row">
        <div class="col-9">
            <h1>Список продуктов</h1>
        </div>
        <div class="col-4">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
                <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4"><ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Sidebar" data-translation="Боковая панель" data-ch="0" data-type="trSpan">Фильтры</ya-tr-span></span>
                <hr>
                {{-- <form id="filterForm" method="get" action="{{ route('products.index') }}"> --}}
                    <div class="form-group">

                    </div>
                    <div class="form-group">
                        <label for="color">Фильтр по цвету:</label>
                        <select name="color" id="color" class="form-control">
                            <option value="">-- Выберите цвет --</option>
                            {{-- @foreach ($colors as $color)
                                <option value="{{ $color }}"  @selected(request('color') == $color)>{{ $color }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="min_price">Минимальная цена:</label>
                        <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="Минимальная цена">

                        <label for="max_price">Максимальная цена:</label>
                        <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="Максимальная цена">
                    </div>

                    <!-- Добавьте другие элементы фильтрации по необходимости -->
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Применить фильтр</button>
                    </div>

                    <div class="form-group">
                        <button type="button" id="resetFilters" class="btn btn-secondary">Сбросить фильтры</button>
                    </div>

                </form>
                {{-- <h3><a href="{{ route('products.index') }}">Сбросить</a></h3> --}}
            </div>
        </div>
        <div class="col-8">
            {{-- <h4>Найдено: {{ $category->products->total() }} товаров</h4> --}}
            {{-- <form id="sortingForm" method="get" action="{{ route('catalog-category') }}"> --}}
                <div class="input-group">
                    <select class="form-select" id="sorting-select" name="sorting">
                        <option value="">-- Выберите сортировку --</option>
                        <option value="price_asc" @selected(request('sorting') == 'price_asc')>Сначала недорогие</option>
                        <option value="price_desc" @selected(request('sorting') == 'price_desc')>Сначала дорогие</option>
                        <option value="created_at_desc" @selected(request('sorting') == 'created_at_desc')>Сначала новые</option>
                        <option value="created_at_asc" @selected(request('sorting') == 'created_at_asc')>Сначала старые</option>
                        <option value="name_asc" @selected(request('sorting') == 'name_asc')>По алфавиту от А</option>
                        <option value="name_desc" @selected(request('sorting') == 'name_desc')>По алфавиту от Я</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Применить</button>
                </div>
            </form>

            @foreach ($category->products as $product)
                <div class="card mb-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($product->images->isNotEmpty())
                                <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $product->images->first()->thumbnail) }}" alt="Описание изображения" width="200" height="200">
                            @else
                                <svg class="bd-placeholder-img img-thumbnail" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text></svg>
                            @endif
                        </div>
                        <div class="col-md-6">
                                <div class="card-body">
                                    <a href="{{ route('catalog.product', ['category' => $category->slug, 'product' => $product->slug]) }}">
                                        <div>
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->detail }}</ya-tr-span></p>
                                        </div>
                                    </a>
                                    <div class="product-rating d-flex align-items-center">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < round($product->rating))
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                        <div class="ms-2">
                                            {{ $product->reviews->count() }}
                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <h5 class="card-price">{{ $product->price }}</h5>
                            <div class="mb-3">
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
            @endforeach


            <table id="productTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Название продукта</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->products as $product)
                        <tr>
                            {{-- <td>
                                <a href="{{ route('catalog.product', ['product' => $product->id]) }}">{{ $product->name }}</a>
                            </td> --}}
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->color }}</td>
                            <td>

                                {{-- <form method="post" action="{{ route('cart.addToCart') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button class="btn btn-success" type="submit">Купить</button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div>
                {{ $category->products->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
            </div> --}}
        </div>
    </div>
</div>

@endsection
