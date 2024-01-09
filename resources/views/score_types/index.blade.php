@extends('layouts.app-admin')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('score.type.store') }}" method="post"> @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление ...</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label" for="name-score-type">Наименование ...</label>
                        <input id="name-score-type" name="name" class="form-control" type="text" placeholder="Наименование ...">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <h1 class="text-center">...</h1>
        <form method="get" action="{{ route('score.type.index') }}">
            <div class="input-group mb-3 ">
                <input name="name" class="form-control" placeholder="Поиск по наименованию" id="findButton"
                       aria-label="" type="text">
                <button class="btn btn-primary" type="submit">Найти</button>
            </div>
        </form>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Добавить
            </button>
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" colspan="3">Наименование ...</th>
                </tr>
                </thead>
                <tbody>
                @foreach($scoreType as $key => $st)
                    <tr>
                        <th>{{$key + 1}}</th>
                        <td>{{$st->name}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-modal-window-{{ $st->id }}">
                                Изменить
                            </button>
                            <div class="modal fade" id="update-modal-window-{{ $st->id }}" tabindex="-1" aria-hidden="true">
                                <form action="{{ route('score.type.update', ['id' => $st->id]) }}" method="post"> @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение ...</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label" for="name-bank">Наименование ...</label>
                                                <input id="name-bank" name="name" class="form-control" type="text" placeholder="Наименование ..." value="{{ $st->name }}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('score.type.delete', ['id' => $st->id]) }}" method="post"> @csrf
                                <button class="btn btn-danger" type="submit">Удалить!</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div>{{ $scoreType->links() }}</div>
    </div>
@endsection
