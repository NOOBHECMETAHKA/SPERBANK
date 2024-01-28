@extends('layouts.app-admin')

@section('content')
    <div class="modal fade" id="create-score" tabindex="-1" aria-labelledby="create-score" aria-hidden="true">
        <form action="{{ route('score.admin.store') }}" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание счёта</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <div class="mb-3 mt-3">
                                <label for="balanceUser" class="form-label">Баланс</label>
                                <input name="balance" type="number" class="form-control" id="balanceUser">
                                @error('balance')
                                <span class="alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="score_type_id" class="form-label">Выберите тип счёта:</label>
                                <select name="score_type_id" class="form-select" id="score_type_id">
                                    @foreach($score_types as $score_type)
                                        <option value="{{ $score_type->id }}">{{ $score_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="user_score_id" class="form-label">Выберите пользователя:</label>
                                <select name="user_score_id" class="form-select" id="user_score_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ \App\Models\User::getFormatString($user) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark">Создать</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <h1 class="text-center">Счёта</h1>
        <div class="card w-25">
            <div class="card-body">
                <h5 class="card-title">История</h5>
                <a href="{{ route('history.score.index') }}" class="btn btn-outline-dark mt-3">Истрия удалённых счётов</a>
                <a href="{{ route('history.index') }}" class="btn btn-outline-dark mt-3">История действий пользователей</a>
                <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal"
                        data-bs-target="#create-score">
                    Создать счёт пользователю
                </button>
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
                            @csrf
                            <button class="btn btn-danger" type="submit">Удалить!</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
