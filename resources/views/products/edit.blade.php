@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>
    @include('layouts.bar')

    <div>
        <h1>Изменить продукт {{ $product->name }}</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Фотографии: </h2>
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
        <hr>
        <h2>Основное:</h2>
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

                <button type="submit" class="btn btn-primary">Изменить</button>
            </div>
        </form>
        <hr>

        <h2>Характеристики:</h2>
        <div>
            @foreach ($product->characteristics as $group => $characteristics)
                <ul>
                    <h4>{{ $characteristics->first()->group->name }}:</h4>
                    @foreach ($characteristics as $characteristic)
                        <ol>
                            <div class="d-flex justify-content-between">
                            <p>{{ $characteristic->attribute->attribute_name }} => {{ $characteristic->value->value }}</p>
                            <form action="{{ route('admin.products.destroyCharacteristics', ['characteristics' => $characteristic->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Вы уверены, что хотите удалить эту характеристику?')">Удалить</button>
                            </form>
                            </div>
                        </ol>
                    @endforeach
                </ul>

            @endforeach
        </div>
        <hr>
        <h2>Добавить характеристики:</h2>
        <form action="{{ route('admin.products.saveAttributes', ['product' => $product->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group mb-4">
                <label for="group_id">Группа аттрибутов: </label>
                <select name="group_id" id="group_id" class="form-control">
                    <option selected>Выберите группу атрибутов</option>
                    @foreach ($groupAttributes as $group)
                        <option value="{{ $group->id }}" @selected( (int) old('group_id') == $group->id) >{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror
                <div class="d-flex">
                    <input type="text" name="new_group" id="new_group" class="form-control" placeholder="Новая группа">
                    <button type="button" class="btn btn-primary" id="add_group_button">Добавить</button>
                </div>


                <label for="attribute_id">Аттрибут: </label>
                <select name="attribute_id" id="attribute_id" class="form-control">
                    <option selected disabled>Выберите атрибут</option>
                </select>
                @error('attribute_id')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror
                <div class="d-flex">
                    <input type="text" name="new_attribute" id="new_attribute" class="form-control" placeholder="Новый атрибут">
                    <button type="button" class="btn btn-primary" id="add_attribute_button">Добавить</button>
                </div>
                <label for="value_id">Значение: </label>
                <select name="value_id" id="value_id" class="form-control">
                    <option selected disabled>Выберите значение</option>
                </select>
                @error('value_id')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror
                <div class="d-flex">
                    <input type="text" name="new_value" id="new_value" class="form-control" placeholder="Новое значение">
                    <button type="button" class="btn btn-primary" id="add_value_button">Добавить</button>
                </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
            </div>
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
                fetch(`/attributes/load-attributes?group_id=${selectedGroupId}`)
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
                fetch(`/attributes/load-values?attribute_id=${selectedAttributeId}`)
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
                fetch('/attributes/create-attributes', {
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
