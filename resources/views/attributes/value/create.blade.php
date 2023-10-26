@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">


        <h1>Создание значения</h1>
        <form method="POST" action="{{ route('admin.attributes.storeValue') }}">
            @csrf
            <div class="form-group mb-4">
                <select name="attribute_id" id="attribute_id" class="form-select">
                    <option selected="">Выберите атрибут</option>
                    @foreach ($attributes as $attribute)
                        <option value="{{ $attribute->id }}">{{ $attribute->attribute_name }}</option>
                    @endforeach
                </select>
                <label for="name">Значение:</label>
                <input type="text" name="value" id="value" class="form-control">

            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>

@endsection
