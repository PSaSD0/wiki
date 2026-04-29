@extends('layouts.app')

@section('content')
    <div id="carouselExampleAutoplaying" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner" style="height: 500px;">
            @foreach($array as $a)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }} h-100">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="text-center p-4">
                            <img src="{{ asset($a->image) }}" class="img-fluid" style="max-height: 400px; width: auto; object-fit: contain;" alt="{{ $a->name ?? 'Product image' }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <h1>Wiki</h1>
    <p>Все настольные игры, как и все люди разные. И каждому человеку по душе своя игра. Кто-то предпочитает филеры, кто-то кооператив, кто-то RPG. На нашей вики вы найдёте справку о всех настольных играх, созданных человеком. Или почти о всех.</p>

    <h4>Последние добавленные игры</h4>
    <div class="container">
        <div class="row gap-3">
            @foreach ($productNew as $a)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center p-0" style="height: 220px">
                            <img src="{{ asset($a->image) }}" class="card-img-top img-fluid" alt="..." style="max-height: 100%; width: auto; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $a->name }}</h5>
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

    <h4 class="mt-3">Часто обсуждаемые игры</h4>
    <div class="container">
        <div class="row gap-3">
            @foreach ($popularProduct as $a)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="text-center p-3" style="height: 220px">
                            <img src="{{ asset($a->image) }}" class="card-img-top img-fluid" alt="..." style="max-height: 100%; width: auto; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $a->name }}</h5>
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
