@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div class="bd-example-snippet bd-code-snippet w-100">


        <h1>Создание группы</h1>
        <form method="POST" action="{{ route('admin.attributes.storeGroup') }}">
            @csrf
            <div class="form-group mb-4">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>
</div>

@endsection
