@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="w-100 d-flex justify-content-center">
            <div class="card w-75">
                <div class="card-body">
                    <h3 class="text-center">Редактирование личных данных</h3>
                    <form class="row g-3" action="{{ route('main.profile.update') }}" method="post">
                        @csrf
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                            @error('first_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="middle_name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                            @error('middle_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Отчество</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                            @error('last_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <br>
                        <div class="col-12">
                            <label for="phone_format_redactor" class="form-label">Номер телефона</label>
                            <input type="text" class="form-control" id="phone_format_redactor" name="phone_number" value="{{ $user->phone_number }}">
                            @error('phone_number')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-warning" type="submit">Сохранить!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
