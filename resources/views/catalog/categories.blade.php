@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Категории</h1>

    <hr>
    @foreach ($categories as $category)
        <div>
            <h2>{{ $category->name }}</h2>
            <h3>{{ $category->slug }}</h3>
        </div>
        <hr>
    @endforeach
</div>


@endsection
