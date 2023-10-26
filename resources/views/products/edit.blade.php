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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex align-content-start flex-wrap">
            @foreach ($product->images as $image)
                <div>
                    <img class="bd-placeholder-img img-thumbnail" src="{{ asset('gallery_products/thumbnails/' . $image->thumbnail) }}" alt="Описание изображения" width="200" height="200">
                    <form method="POST" action="{{ route('admin.products.destroyImage', ['image' => $image->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                </div>
            @endforeach
        </div>
        <form method="POST" action="{{ route('admin.products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group mb-4">

                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    @error('name')
                        <p><span class="text-danger">{{ $message }}</span></p>
                    @enderror

                    <label for="description">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ $product->description }}">
                    @error('description')
                        <p><span class="text-danger">{{ $message }}</span></p>
                    @enderror

                    <label for="detail">Detail:</label>
                    <input type="text" name="detail" id="detail" class="form-control"value="{{ $product->detail }}">
                    @error('detail')
                        <p><span class="text-danger">{{ $message }}</span></p>
                    @enderror

                    <label for="category_id">Category:</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option selected="">Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected( $product->category->id == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p><span class="text-danger">{{ $message }}</span></p>
                    @enderror

                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
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

                <button type="submit" class="btn btn-primary">Изменить</button>
                <a class="btn btn-primary" href="{{ route('admin.products.show', ['product' => $product->slug]) }}">Назад</a>
            </form>

    </div>

</div>

@endsection
