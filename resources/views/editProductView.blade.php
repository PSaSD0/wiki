@extends('layouts.app')

@section('content')
    <h1>Редактирование товара</h1>
    <div class="card" style="width: 50%;">
        <img src="{{ asset($products->image) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <form action="{{ route('editProduct', ['id'=>$products->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="image" class="form-label">Фото игры</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*"><br>

                <label for="name" class="form-label">Название игры</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $products->name }}"><br>

                <label for="about" class="form-label">Описание игры</label>
                <textarea type="text" class="form-control" id="about" name="about">{{ $products->about }}</textarea><br>

                <label for="how_to_play" class="form-label">Как играть?</label>
                <textarea type="text" class="form-control" id="how_to_play" name="how_to_play">{{ $products->how_to_play }}</textarea><br>

                <label for="inside_box" class="form-label">Что в коробке?</label>
                <textarea type="text" class="form-control" id="inside_box" name="inside_box">{{ $products->inside_box }}</textarea><br>

                <select name="id_genre" id="id_genre" class="form-select">
                    @foreach ($genres as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <select name="id_time" id="id_time" class="form-select">
                    @foreach ($times as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <select name="id_publishers" id="id_publishers" class="form-select">
                    @foreach ($publishers as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <select name="id_rules" id="id_rules" class="form-select">
                    @foreach ($rules as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('catalog') }}" class="btn btn-primary">Отмена</a>
                <p>{{ session('messageEditProduct') }}</p>
            </form>
        </div>
    </div>
@endsection
