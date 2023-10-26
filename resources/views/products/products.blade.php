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
                <form id="filterForm" method="get" action="{{ route('products.index') }}">
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

                    <div class="form-group">
                        <label for="category">Фильтр по категории:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">-- Выберите Категорию --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
                            @endforeach
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
            <h3><a href="{{ route('products.create') }}">Создать новый продукт</a></h3>
            <h4>Найдено: {{ $products->total() }} товаров</h4>
            <form id="sortingForm" method="get" action="{{ route('products.index') }}">
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

            <table id="productTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Название продукта</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Цвет</th>
                        <th>Дата публикации</th>
                        <th>Дата изменения</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->name }}</a>
                            </td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product->id]) }}">Редактировать</a>

                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
                                </form>

                                <form method="post" action="{{ route('cart.addToCart') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button class="btn btn-success" type="submit">Купить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $products->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script>
    jQuery(document).ready(function($) {
        $('#filterForm, #sortingForm').change(function(event) {
            event.preventDefault();

            const filterData = $('#filterForm').serialize();
            const sortingData = $('#sortingForm').serialize();

            // Объединяет данные из обоих форм
            const requestData = filterData + '&' + sortingData;
            sendFilterRequest(requestData);
        });

        $('#resetFilters').click(function() {
            // Очищаем все значения в форме фильтрации
            $('#filterForm').find('input, select').val('');

            const filterData = $('#filterForm').serialize();
            const sortingData = $('#sortingForm').serialize();

            const requestData = filterData + '&' + sortingData;
            // Отправляем пустой GET-запрос для сброса фильтров
            sendFilterRequest(requestData);
        });

        function sendFilterRequest(data) {

            const filteredData = data.split('&').filter(param => {
                const [key, value] = param.split('=');
                return value !== '';
            }).join('&');

            $.ajax({
                    url: '{{ route('products.index') }}',
                    type: 'GET',
                    data: filteredData,
                    success: function(response) {
                        $('body').html(response);

                        // Обновляем URL с GET-параметрами
                        window.history.pushState(null, null, '{{ route('products.index') }}?' + filteredData);
                    }
            });
        };
    })
</script>


