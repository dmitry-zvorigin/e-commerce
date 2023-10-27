@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="container">
        <h1>Продукт: {{ $product->name }}</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex">
            <a class="btn btn-success" href="{{ route('admin.products.edit', ['product' => $product->slug]) }}">Изменить</a>
            <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
            </form>
            <a href="{{ route('admin.products.createAttributes', ['product' => $product->slug]) }}" class="btn btn-primary">Добавить характеристики</a>
        </div>
        <div class="d-flex align-content-start justify-content-around flex-wrap">
            @foreach ($product->images as $image)
                <div>
                    <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $image->thumbnail) }}" alt="Описание изображения" width="200" height="200">
                </div>
            @endforeach
        </div>
        <div class="col">
            <div class="card">
                <h3>Товар</h3>
                <div class="card-body">
                    <h5 class="card-title">Название: </h5>
                    <p class="card-text">{{ $product->name }}</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Описание: </h5>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Детали: </h5>
                    <p class="card-text">{{ $product->detail }}</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Цена: </h5>
                    <p class="card-text">{{ $product->price }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <h3>Характеристики</h3>
                <div class="card-body">
                    @foreach ($product->characteristics as $characteristics)
                        <p>{{ $characteristics->attribute->attribute_name }} => {{ $characteristics->value->value }}</p>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

