@extends('layouts.app')

@section('content')



<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">
        <h1>Категории</h1>
        <div class="bd-example m-0 border-0">
            <form method="GET" action="{{ route('admin.categories.index') }}" class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto d-flex" role="search">
                <input name="search" type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Поиск</button>
            </form>
            {{-- <form method="GET" action="{{ route('products.index') }}">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Поиск продуктов">
                </div>
                <button type="submit" class="btn btn-primary">Искать</button>
            </form> --}}
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Создать</a>
            <a class="btn btn-primary" href="{{ route('admin.categories.index') }}">Сбросить</a>
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Slug</th>
            <th scope="col">Действия</th>
          </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
                <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                    <div class="d-flex">
                        <a class="btn btn-primary" href="{{ route('admin.categories.show', ['category' => $category->slug]) }}">Посмотреть</a>
                        <a class="btn btn-success" href="{{ route('admin.categories.edit', ['category' => $category->slug]) }}">Изменить</a>

                        <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
                        </form>
                    </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $categories->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>


</div>

@endsection
