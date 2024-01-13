@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="{{ route('employee.update', [$user->id]) }}" method="post" class="w-75">
                @csrf
                <h2 class="text-center">Редактирование данных сотрудников</h2>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Фамилия</label>
                    <input name="first_name" class="form-control" type="text" id="first_name" value="{{ $user->first_name }}">
                </div>
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Имя</label>
                    <input name="middle_name"  class="form-control" type="text" id="middle_name" value="{{ $user->middle_name }}">
                </div>
                @error('middle_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="mb-3">
                    <label for="last_name" class="form-label">Отчество</label>
                    <input name="last_name"  class="form-control" type="text" id="last_name" value="{{ $user->last_name }}">
                </div>
                @error('last_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3">
                    <label for="phone_format_redactor" class="form-label">Номер телефона</label>
                    <input name="phone_number"  class="form-control" type="text" id="phone_format_redactor" value="{{ $user->phone_number }}">
                </div>
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>Роли сотрудника</h5>
                        @foreach(\App\Models\Roles::$roles as  $key => $availableRoles)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $key }}" id="{{ $key }}"
                                @foreach($roles as $role) @if($role->name == $key) checked @endif @endforeach>
                                <label class="form-check-label" for="{{ $key }}">
                                    {{ $availableRoles }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
