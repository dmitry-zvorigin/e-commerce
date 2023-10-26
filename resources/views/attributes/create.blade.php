
@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Создать характеристику</h1>
        <form action="{{ route('admin.products.saveAttributes') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group mb-4">

                <label for="group_id">Группа аттрибутов: </label>
                <select name="group_id" id="group_id" class="form-control">
                    <option selected disabled>Выберите группу атрибутов</option>
                    @foreach ($groupAttributes as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                <label for="attribute_id">Аттрибут: </label>
                <select name="attribute_id" id="attribute_id" class="form-control">
                    <option selected disabled>Выберите атрибут</option>
                </select>
                <label for="value_id">Значение: </label>
                <select name="value_id" id="value_id" class="form-control">
                    <option selected disabled>Выберите значение</option>
                </select>

            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>


</div>

@endsection


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const groupSelect = document.getElementById('group_id');
        const attributeSelect = document.getElementById('attribute_id');
        const valueSelect = document.getElementById('value_id');

        groupSelect.addEventListener('change', function () {
            // Получаем выбранное значение группы атрибутов
            const selectedGroupId = this.value;
            attributeSelect.innerHTML = '<option selected disabled>Выберите атрибут</option>';
            valueSelect.innerHTML = '<option selected disabled>Выберите значение</option>';

            if (selectedGroupId) {
                // Если выбрана группа, отправляем Ajax-запрос для загрузки атрибутов
                fetch(`/products/load-attributes?group_id=${selectedGroupId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Парсим JSON-ответ и добавляем атрибуты в выпадающий список
                        data.forEach(attribute => {
                            const option = document.createElement('option');
                            option.value = attribute.id;
                            option.textContent = attribute.attribute_name;
                            attributeSelect.appendChild(option);
                        });

                        // Устанавливаем значение атрибута
                        attributeSelect.addEventListener('change', function() {
                            const selectedArrtibuteId = this.value;

                            if (selectedArrtibuteId) {
                                fetch(`/products/load-value?attribute_id=${selectedArrtibuteId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        valueSelect.innerHTML = '<option selected disabled>Выберите значение</option>';
                                        option.value = value.id;
                                        option.textContent = value.value;
                                        valueSelect.appendChild(option);
                                    });
                            }
                        })
                        .catch(error => console.error('Ошибка загрузки значений', error));

                    })
                    .catch(error => console.error('Ошибка загрузки атрибутов', error));
            }
        });
    });
</script> --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const groupSelect = document.getElementById('group_id');
    const attributeSelect = document.getElementById('attribute_id');
    const valueSelect = document.getElementById('value_id');

    groupSelect.addEventListener('change', function () {
        // Получаем выбранное значение группы атрибутов
        const selectedGroupId = this.value;
        attributeSelect.innerHTML = '<option selected disabled>Выберите атрибут</option>';
        valueSelect.innerHTML = '<option selected disabled>Выберите значение</option>';

        if (selectedGroupId) {
            // Если выбрана группа, отправляем Ajax-запрос для загрузки атрибутов
            fetch(`/products/load-attributes?group_id=${selectedGroupId}`)
                .then(response => response.json())
                .then(data => {
                    // Парсим JSON-ответ и добавляем атрибуты в выпадающий список
                    data.forEach(attribute => {
                        const option = document.createElement('option');
                        option.value = attribute.id;
                        option.textContent = attribute.attribute_name;
                        attributeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Ошибка загрузки атрибутов', error));
        }
    });

    attributeSelect.addEventListener('change', function () {
        const selectedAttributeId = this.value;
        valueSelect.innerHTML = '<option selected disabled>Выберите значение</option>';

        if (selectedAttributeId) {
            // Если выбран атрибут, отправляем Ajax-запрос для загрузки значений
            fetch(`/products/load-values?attribute_id=${selectedAttributeId}`)
                .then(response => response.json())
                .then(data => {
                    // Парсим JSON-ответ и добавляем значения в выпадающий список
                    data.forEach(value => {
                        const option = document.createElement('option');
                        option.value = value.id;
                        option.textContent = value.value;
                        valueSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Ошибка загрузки значений', error));
        }
    });
});
</script>
