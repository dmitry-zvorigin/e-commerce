{{-- <div class="container">
    <a href="{{ route('products.index') }}">На главную</a>
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <!-- Другие поля продукта здесь -->

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div> --}}

@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Изменить продукт</h1>
        <form method="POST" action="{{ route('admin.products.update', ['product' => $product->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                <label for="name">Description:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $product->description }}">
                <label for="name">Detail:</label>
                <input type="text" name="detail" id="detail" class="form-control" value="{{ $product->detail }}">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option selected="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id === $product->category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
    </div>

</div>

@endsection
