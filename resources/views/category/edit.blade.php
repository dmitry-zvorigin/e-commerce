@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Изменить категорию</h1>
        <form method="POST" action="{{ route('admin.categories.update', ['category' => $category->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>

</div>

@endsection
