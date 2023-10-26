@extends('layouts.app')

@section('content')



<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">
        <h1>Продукты</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="bd-example m-0 border-0">
            <form method="get" action="{{ route('admin.products.index') }}" class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto d-flex" role="search">
                <input name="search" type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
            <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Создать</a>
            <a class="btn btn-primary" href="{{ route('admin.products.index') }}">Сбросить</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Изображение</th>
                <th scope="col">Название</th>
                <th scope="col">Slug</th>
                <th scope="col">Описание</th>
                <th scope="col">Детали</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>
                            @if ($product->images->isNotEmpty())
                                <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $product->images->first()->thumbnail) }}" alt="Описание изображения" width="200" height="200">
                            @else
                                <svg class="bd-placeholder-img img-thumbnail" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text></svg>
                            @endif

                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->detail }}</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-primary" href="{{ route('admin.products.show', ['product' => $product->slug]) }}">Посмотреть</a>
                                <a class="btn btn-success" href="{{ route('admin.products.edit', ['product' => $product->slug]) }}">Изменить</a>

                                <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $products->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>


</div>

@endsection
