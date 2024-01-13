@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <h1 class="text-center">Счёта</h1>
        <div class="card w-25">
            <div class="card-body">
                <h5 class="card-title">История</h5>
                <a href="" class="btn btn-outline-dark mt-3">Истрия удалённых счётов</a>
                <a href="" class="btn btn-outline-dark mt-3">История действий пользователей</a>
                <a href="" class="btn btn-success mt-3">Создать счёт пользователю</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Номер счёта</th>
                <th scope="col">Баланс</th>
                <th scope="col">Дата открытия</th>
                <th scope="col" colspan="2">Пользователь</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scores as $score)
                <tr>
                    <td>{{ $score->score_number }}</td>
                    <td>{{ $score->balance }}</td>
                    <td>{{ $score->opening_date }}</td>
                    <td>{{ \App\Models\User::getFormatString($users->where('id', $score->user_score_id)->first()) }}</td>
                    <td>
                        <form action="{{ route('score.delete', ['id' => $score->id]) }}" method="post">
                            <button class="btn btn-danger" type="submit">Удалить!</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
