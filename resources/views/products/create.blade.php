{{-- <div class="container">
    <a href="{{ route('products.index') }}">На главную</a>
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" class="form-control">
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" name="color" id="color" class="form-control">
        </div>
        <!-- Другие поля продукта здесь -->

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div> --}}

@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Создать продукт</h1>
        <form action="{{ route('admin.products.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group mb-4">

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="description">Description:</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
                @error('description')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="detail">Detail:</label>
                <input type="text" name="detail" id="detail" class="form-control"value="{{ old('detail') }}">
                @error('detail')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option selected="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected( (int) old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="price">Price:</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
                @error('price')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="images">Images:</label>
                <input name="images[]" type="file" class="form-control" id="files" accept="image/png, image/jpeg"  multiple>
                @error('images')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

</div>

@endsection
