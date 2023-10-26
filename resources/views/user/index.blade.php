@extends('layouts.app')

@section('content')



<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">
        <h1>Пользователи</h1>
        <div class="bd-example m-0 border-0">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto d-flex" role="search">
                <input type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск">
                <button type="button" class="btn btn-primary">Поиск</button>
            </form>
        <table class="table table-striped">
          <thead>
          <tr>
            {{-- {{ dd($users)}} --}}
            <th scope="col">#</th>
            <th scope="col">Имя</th>
            <th scope="col">Email</th>
            <th scope="col">Ник</th>
            <th scope="col">Статус</th>
            <th scope="col">Роль</th>
            <th scope="col">Действия</th>
          </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
                <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->nick }}</td>
                <td>Статус</td>
                <td>Роль</td>
                <td>
                    <p>
                        <a class="btn btn-primary" href="">Посмотреть</a>
                    </p>
                    <p>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите забанить данного пользователя?')">Забанить</button>
                        </form>
                    </p>

                    {{-- <div class="d-flex">
                        <a class="btn btn-primary" href="{{ route('admin.categories.show', ['user' => $user->slug]) }}">Посмотреть</a>
                        <a class="btn btn-success" href="{{ route('admin.categories.edit', ['user' => $user->slug]) }}">Изменить</a>

                        <form action="{{ route('admin.categories.destroy', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить этот продукт?')">Удалить</button>
                        </form>
                    </div> --}}
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>


</div>

@endsection
