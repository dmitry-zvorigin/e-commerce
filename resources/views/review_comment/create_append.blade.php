
@extends('layouts.app')

@section('content')

<div class='d-flex flex-nowrap container'>

    <div>
        <h1>Создать комментарий к комментарию {{ $comment->user->name }}</h1>

        <form action="{{ route('review.comment.append.store', ['comment' => $comment]) }}" method="post">
            @csrf
            <div class="form-group mb-4">
                <label for="comment">Комментарий:</label>
                <textarea class="form-control" name="comment" id="comment" rows="3" style="height: 167px;">{{ old('comment') }}</textarea>
                {{-- <input type="text" name="dignitas" id="dignitas" class="form-control" value="{{ old('dignitas') }}"> --}}
                @error('comment')
                    <p><span class="text-danger">{{ $message }}</span></p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>

        </form>
    </div>

</div>

@endsection
