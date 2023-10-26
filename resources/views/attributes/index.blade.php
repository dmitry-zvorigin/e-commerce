@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">

        <h1>Атрибуты</h1>
        <div>
            <a class="btn btn-primary" href="{{ route('admin.attributes.createGroup') }}">Добавить группу</a>
            <a class="btn btn-primary" href="{{ route('admin.attributes.createAttribute') }}">Добавить атрибут</a>
            <a class="btn btn-primary" href="{{ route('admin.attributes.createValue') }}">Добавить значение</a>
            <a class="btn btn-primary" href="">Добавить все сразу</a>
        </div>
        <div class="bd-example m-0 border-0">
            <form class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto d-flex" role="search">
                <input type="search" class="form-control" placeholder="Поиск..." aria-label="Поиск">
                <button type="button" class="btn btn-primary">Поиск</button>
            </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Группа</th>
                <th scope="col">Атрибуты</th>
                <th scope="col">Значения</th>
            </tr>
            </thead>
            <tbody>
                @foreach($attributes as $attribute)
                <tr>
                    {{-- {{ dd($attribute->group_attribute) }} --}}
                    <th scope="row">{{ $attribute->id }}</th>
                    <td>{{ $attribute->group_attribute->name }}</td>
                    <td>{{ $attribute->attribute_name }}</td>
                    <td>
                        @foreach ($attribute->attribute_value as $value)
                            <ul>
                                <li>{{ $value->value }}</li>
                            </ul>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>



        </div>
        <div class="d-flex justify-content-center">
            {{ $groups->withQueryString()->links('vendor.pagination.simple-bootstrap-5') }}
        </div>
    </div>


</div>

@endsection
