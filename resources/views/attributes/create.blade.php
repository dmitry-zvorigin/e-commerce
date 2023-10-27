
@extends('layouts.app')

@section('content')


<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Создать характеристику</h1>
        <form action="{{ route('admin.products.saveAttributes', ['product' => $product->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group mb-4">
                <label for="group_id">Группа аттрибутов: </label>
                <select name="group_id" id="group_id" class="form-control">
                    <option selected disabled>Выберите группу атрибутов</option>
                    @foreach ($groupAttributes as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                <div class="d-flex">
                    <input type="text" name="new_group" id="new_group" class="form-control" placeholder="Новая группа">
                    <button type="button" class="btn btn-primary" id="add_group_button">Добавить</button>
                </div>

                <label for="attribute_id">Аттрибут: </label>
                <select name="attribute_id" id="attribute_id" class="form-control">
                    <option selected disabled>Выберите атрибут</option>
                </select>
                <div class="d-flex">
                    <input type="text" name="new_attribute" id="new_attribute" class="form-control" placeholder="Новый атрибут">
                    <button type="button" class="btn btn-primary" id="add_attribute_button">Добавить</button>
                </div>
                @error('new_attribute')
                    1
                @enderror
                <label for="value_id">Значение: </label>
                <select name="value_id" id="value_id" class="form-control">
                    <option selected disabled>Выберите значение</option>
                </select>
                <div class="d-flex">
                    <input type="text" name="new_value" id="new_value" class="form-control" placeholder="Новое значение">
                    <button type="button" class="btn btn-primary" id="add_value_button">Добавить</button>
                </div>


            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const groupSelect = document.getElementById('group_id');
    const attributeSelect = document.getElementById('attribute_id');
    const valueSelect = document.getElementById('value_id');

    const newGroupInput = document.getElementById('new_group');
    const newAttributeInput = document.getElementById('new_attribute');
    const newValueInput = document.getElementById('new_value');

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

    const addGroupButton = document.getElementById('add_group_button');
    addGroupButton.addEventListener('click', function() {
        const newGroup = newGroupInput.value;
        if (newGroup) {
            fetch('/attributes/create-group', {
                method: 'POST',
                body: JSON.stringify({ group_name: newGroup }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.name;
                groupSelect.appendChild(option);
                newGroupInput.value = '';
            })
            .catch(error => console.log('Ошибка создания группы атрибутов'));
        }
    });

    const addAttributeButton = document.getElementById('add_attribute_button');
    addAttributeButton.addEventListener('click', function() {
        const newAttribute = newAttributeInput.value;
        const group = groupSelect.value;

        const errorElement = document.getElementById('attribute_error');
        if (errorElement) {
            errorElement.remove();
        }

        if (newAttribute) {
            fetch('/attributes/create-attribute', {
                method: 'POST',
                body: JSON.stringify({ attribute_name: newAttribute, group_id: group }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.attribute_name;
                attributeSelect.appendChild(option);
                newAttributeInput.value = '';
            })
            .catch(error => {
                console.log('Ошибка создания аттрибута', error);

                const errorElement = document.createElement('div');
                errorElement.id = 'attribute_error';
                errorElement.classList.add('text-danger');
                errorElement.textContent = 'Произошла ошибка при создании атрибута';
                document.body.appendChild(errorElement);
            });
        }
    });

    const addValueButton = document.getElementById('add_value_button');
    addValueButton.addEventListener('click', function() {
        const newValue = newValueInput.value;
        const attribute = attributeSelect.value;
        if (newValue) {
            fetch('/attributes/create-value', {
                method: 'POST',
                body: JSON.stringify({ value: newValue, attribute_id: attribute }),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                const option = document.createElement('option');
                option.value = data.id;
                option.textContent = data.value;
                valueSelect.appendChild(option);
                newValueInput.value = '';
            })
            .catch(error => console.log('Ошибка создания значения'));
        }
    });


});
</script>
