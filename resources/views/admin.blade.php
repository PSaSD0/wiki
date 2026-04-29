@extends('layouts.app')

@section('content')
    <h1>Админ панель</h1>
    <form method="post" action="{{ route('addGenres') }}">
        @csrf
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Добавление жанра</h5>
                <label for="nameGenres" class="form-label">Название жанра</label>
                <input type="text" class="form-control" id="nameGenres" name="nameGenres"><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <p>{{ session('messageAddGenres') }}</p>
            </div>
        </div>
    </form><br>

    <form method="post" action="{{ route('dellGenres') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Удаление жанра</h5>
                <select name="id_genres" id="" class="form-select">
                    @foreach ($genres as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-danger">Удалить</button>
                <p>{{ session('messageDellGenres') }}</p>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('addTimes') }}" class="mt-5">
        @csrf
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Добавление времени игры</h5>
                <label for="nameTimes" class="form-label">Время игры</label>
                <input type="text" class="form-control" id="nameTimes" name="nameTimes"><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <p>{{ session('messageAddTimes') }}</p>
            </div>
        </div>
    </form><br>

    <form method="post" action="{{ route('dellTimes') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Удаление времени игры</h5>
                <select name="id_times" id="" class="form-select">
                    @foreach ($times as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-danger">Удалить</button>
                <p>{{ session('messageDellTimes') }}</p>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('addPublishers') }}" class="mt-5">
        @csrf
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Добавление издателя</h5>
                <label for="namePublishers" class="form-label">Названеи издателя</label>
                <input type="text" class="form-control" id="namePublishers" name="namePublishers"><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <p>{{ session('messageAddPublishers') }}</p>
            </div>
        </div>
    </form><br>

    <form method="post" action="{{ route('dellPublishers') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Удаление издателя</h5>
                <select name="id_publishers" id="" class="form-select">
                    @foreach ($publishers as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-danger">Удалить</button>
                <p>{{ session('messageDellPublishers') }}</p>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('addRules') }}" class="mt-5">
        @csrf
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Добавление уровня сложности игры</h5>
                <label for="nameRules" class="form-label">Сложность правил</label>
                <input type="text" class="form-control" id="nameRules" name="nameRules"><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <p>{{ session('messageAddRules') }}</p>
            </div>
        </div>
    </form><br>

    <form method="post" action="{{ route('dellRules') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Удаление уровня сложности игры</h5>
                <select name="id_rules" id="" class="form-select">
                    @foreach ($rules as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-danger">Удалить</button>
                <p>{{ session('messageDellRules') }}</p>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('addProduct') }}" enctype="multipart/form-data" class="mt-5">
        @csrf
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Добавление игры</h5>
                <label for="image" class="form-label">Фото игры</label>
                <input type="file" class="form-control" id="image" name="image" required accept="image/*"><br>

                <label for="nameProduct" class="form-label">Название игры</label>
                <input type="text" class="form-control" id="nameProduct" name="nameProduct"><br>

                <label for="aboutProduct" class="form-label">Об игре</label>
                <textarea type="text" class="form-control" id="aboutProduct" name="aboutProduct"></textarea><br>

                <label for="howToPlayProduct" class="form-label">Как играть?</label>
                <textarea type="text" class="form-control" id="howToPlayProduct" name="howToPlayProduct"></textarea><br>

                <label for="insideBoxProduct" class="form-label">Что в коробке?</label>
                <textarea type="text" class="form-control" id="insideBoxProduct" name="insideBoxProduct"></textarea><br>

                <label for="id_genres" class="form-label">Выбор жанра</label>
                <select name="id_genres" id="id_genres" class="form-select">
                    @foreach ($genres as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <label for="id_times" class="form-label">Выбор времени игры</label>
                <select name="id_times" id="id_times" class="form-select">
                    @foreach ($times as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <label for="id_publishers" class="form-label">Выбор издателя</label>
                <select name="id_publishers" id="id_publishers" class="form-select">
                    @foreach ($publishers as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <label for="id_rules" class="form-label">Выбор сложности</label>
                <select name="id_rules" id="id_rules" class="form-select">
                    @foreach ($rules as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>

                <button type="submit" class="btn btn-primary">Добавить</button>
                <p>{{ session('messageAddProduct') }}</p>
            </div>
        </div>
    </form>

    <form method="post" action="{{ route('dellUser') }}" class="mt-5">
        @csrf
        @method('DELETE')
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h5 class="card-title">Удаление пользователя</h5>
                <select name="id" id="" class="form-select">
                    @foreach ($users as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-danger">Удалить</button>
                <p>{{ session('messageDellUser') }}</p>
            </div>
        </div>
    </form>
@endsection
