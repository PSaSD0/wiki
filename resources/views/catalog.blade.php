@extends('layouts.app')

@section('content')
    <h1>Все настольные игры</h1>
    <form action="{{ route('catalog') }}" method="get">
        <div class="d-flex justify-content-start">
            <select class="form-select m-5 ms-0" style="width: 250px;" name="sort">
                <option value="">Сортировка</option>
                <option value="genre" {{ request('sort') == 'genre' ? 'selected' : '' }}>По жанру</option>
                <option value="time" {{ request('sort') == 'time' ? 'selected' : '' }}>По времени игры</option>
                <option value="publisher" {{ request('sort') == 'publisher' ? 'selected' : '' }}>По издателю</option>
                <option value="rule" {{ request('sort') == 'rule' ? 'selected' : '' }}>По сложности правил</option>
            </select>
            <button type="submit" class="btn btn-success m-5">Отфильтровать</button>
        </div>
    </form>

    <div class="container">
        <div class="row gap-3">
            @foreach ($array as $a)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center p-0" style="height: 220px">
                            <img src="{{ asset($a->image) }}" class="card-img-top img-fluid" alt="..." style="max-height: 100%; width: auto; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $a->name }}</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item ps-0">Жанр: {{ $a->genre_name }}</li>
                                <li class="list-group-item ps-0">Время игры: {{ $a->time_name }}</li>
                                <li class="list-group-item ps-0">Сложность правил: {{ $a->rule_name }}</li>
                                <li class="list-group-item ps-0">Издатель: {{ $a->publisher_name }}</li>
                            </ul>
                            <a href="{{ route('card', $a->id) }}" class="btn btn-primary btn-sm">Перейти</a><br>
                            @auth
                                @if(Auth::user()->id_role == 1)
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('editProductView', ['id'=>$a->id]) }}" class="btn btn-secondary btn-sm mt-2 me-2">Редактировать</a>

                                    <form action="{{ route('dellProduct') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $a->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Удалить</button>
                                    </form>
                                </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
