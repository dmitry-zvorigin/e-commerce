@extends('layouts.app')

@section('content')


<div class='container'>

    <h1>Каталог товаров</h1>

    <div class="row row-cols-3">
        @foreach ($categories as $category)
        {{-- <a href="{{ route('catalog-category', ['catagory' => $category->slug]) }}">
            <p>{{ $category->name }}</p>
        </a> --}}
        <div class="card col">
            <a href="{{ route('catalog.category', ['catagory' => $category->slug]) }}">
                <div class="row g-0">

                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                    </div>

                </div>
            </a>

        </div>

        @endforeach
    </div>


</div>

@endsection
