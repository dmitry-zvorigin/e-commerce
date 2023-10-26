@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Продукт: {{ $product->name }}</h1>
        <hr>
        <div class="d-flex justify-content-between">
            @foreach ($product->images as $image)
                <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/' . $image->image) }}" alt="Описание изображения" width="200" height="200">
            @endforeach
        </div>
        <div class="col">
            <div class="card">
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
    </div>

</div>

@endsection

