
@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>

    <div>
        <h1>Создать отзыв</h1>
        <form action="{{ route('review.store', ['product' => $product->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group mb-4">

                <label for="dignities">Достоинства:</label>
                <textarea class="form-control" name="dignities" id="dignities" rows="3" style="height: 167px;">{{ old('dignities') }}</textarea>
                {{-- <input type="text" name="dignitas" id="dignitas" class="form-control" value="{{ old('dignitas') }}"> --}}
                @error('dignities')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="disadvantages">Недостатки:</label>
                <textarea class="form-control" name="disadvantages" id="disadvantages" rows="3" style="height: 167px;">{{ old('disadvantages') }}</textarea>
                {{-- <input type="text" name="disadvantages" id="disadvantages" class="form-control" value="{{ old('disadvantages') }}"> --}}
                @error('disadvantages')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="comment">Комментарий:</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" style="height: 167px;">{{ old('comment') }}</textarea>
                {{-- <input type="text" name="comment" id="comment" class="form-control"value=""> --}}
                @error('comment')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="rating">Рейтинг:</label>

                <input type="number" name="rating" id="rating" class="form-control" value="{{ old('rating') }}">
                @error('rating')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

                <label for="images">Фотографии:</label>
                <input name="images[]" type="file" class="form-control" id="files" accept="image/png, image/jpeg"  multiple>
                @error('images')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror

            </div>
            <!-- Другие поля продукта здесь -->

            <button type="submit" class="btn btn-primary">Создать</button>
        </form>
    </div>

</div>

@endsection
