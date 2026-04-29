@extends('layouts.app')

@section('content')
    <h1>Профиль</h1>
    <div class="card mb-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Имя:</b> {{ $user->name }}</li>
            <li class="list-group-item"><b>Почта:</b> {{ $user->email}}</li>
            <li class="list-group-item"><b>Дата создания аккаунта:</b> {{ $user->created_at }}</li>
        </ul>
    </div>

    <h3>Мои обсуждения</h3>
    @if($products->isEmpty())
        <div class="alert alert-info">
            Вы еще не оставляли сообщения ни в одном обсуждении.
        </div>
    @else
        <div class="container">
            <div class="row gap-3">
                @foreach ($products as $a)
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <div class="text-center p-0" style="height: 220px">
                                <img src="{{ asset($a->image) }}" class="card-img-top img-fluid" alt="..." style="max-height: 100%; width: auto; max-width: 100%; object-fit: contain;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $a->name }}</h5>
                                <p>Ваших сообщений: {{ $a->messages_count }}</p>
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
    @endif
@endsection
