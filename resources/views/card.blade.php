@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7 order-md-1">
            <h1>{{ $card->name }}</h1><br>
            <h4>Об игре</h4>
            <p>{{ $card->about }}</p>
            <h4>Как играть?</h4>
            <p>{{ $card->how_to_play }}</p>
            <h4>Что в коробке?</h4>
            <p>{{ $card->inside_box }}</p>

            <h4>Обсуждение</h4>

            @if(session('messageAddMessage'))
                <div class="alert alert-success">
                    {{ session('messageAddMessage') }}
                </div>
            @endif

            @auth
                @if(Auth::user())
                    <form action="{{ route('addMessage', $card->id) }}" method="post">
                        @csrf
                        <textarea type="text" class="form-control" id="message" name="message" rows="3" placeholder="Напишите свое сообщение"></textarea><br>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                @endif
            @endauth

            <div class="mt-4">
                <h5>Все сообщения ({{ count($messages) }})</h5>

                @if($messages->isEmpty())
                    <p>Сообщений нет</p>
                @else
                    @foreach($messages as $message)
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <b>{{ $message->user_name }}</b>
                                    <small class="text-muted">{{ $message->created_at }}</small>
                                </div>
                                <div class="d-flex justify-content-between">
                                <p class="mt-2 mb-0">{{ $message->message }}</p>
                                    @auth
                                        @if(Auth::user()->id_role == 1)
                                            <form action="{{ route('dellMessage') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $message->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm mt-2">Удалить сообщение</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-md-5 order-md-2 mt-3">
            <div class="card">
                <img src="{{ asset($card->image) }}" class="card-img-top" alt="...">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Жанр:</b> {{ $card->genre_name }}</li>
                    <li class="list-group-item"><b>Время игры:</b> {{ $card->time_name }}</li>
                    <li class="list-group-item"><b>Сложность правил:</b> {{ $card->rule_name }}</li>
                    <li class="list-group-item"><b>Издатель:</b> {{ $card->publisher_name }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
