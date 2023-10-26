@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">


        <h1>Создание атрибута</h1>
        <form method="POST" action="{{ route('admin.attributes.storeAttribute') }}">
            @csrf
            <div class="form-group mb-4">
                <select name="group_id" id="group_id" class="form-select">
                    <option selected="">Выберите группу</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                <label for="name">Name:</label>
                <input type="text" name="attribute_name" id="attribute_name" class="form-control">

            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>

@endsection
