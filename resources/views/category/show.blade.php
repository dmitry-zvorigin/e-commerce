@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Категория: {{ $category->name }}</h1>
    </div>

</div>

@endsection

