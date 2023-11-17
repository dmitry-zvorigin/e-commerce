@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="container">
            <h1>{{ $product->name }}</h1>
            <div>
                <div class="card">
                    <div class="d-flex">
                        {{-- Product Images --}}
                        <x-product-images :images="$product->images"/>
                        {{-- Product Details --}}
                        <x-product-details :product="$product"/>
                    </div>
                </div>
                {{-- Product Characteristics--}}
                <x-product-characteristics :product="$product"/>
                {{-- Product Description --}}
                <x-product-description :description="$product->description"/>
                {{-- Product Review Panel--}}
                <x-product-review-panel :product="$product"/>
                {{-- Product Review Sorting --}}
                <x-product-review-sorting :product="$product" :category="$category"/>
                {{-- Product Review --}}
                <x-product-review :reviews="$product->reviews"/>
            </div>
        </div>
    </div>

@endsection