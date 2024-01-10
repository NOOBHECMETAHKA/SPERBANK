@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <form action="{{ route('employee.store') }}" method="post" class="w-75">
                @csrf
                <h2 class="text-center">Добавление сотрудника</h2>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Фамилия</label>
                    <input name="first_name" class="form-control" type="text" id="first_name" value="{{ old('first_name') }}">
                </div>
                @error('first_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Имя</label>
                    <input name="middle_name"  class="form-control" type="text" id="middle_name" value="{{ old('middle_name') }}">
                </div>
                @error('middle_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3">
                    <label for="last_name" class="form-label">Отчество</label>
                    <input name="last_name"  class="form-control" type="text" id="last_name" value="{{ old('last_name') }}">
                </div>
                @error('last_name')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3">
                    <label for="phone_format_redactor" class="form-label">Номер телефона</label>
                    <input name="phone_number"  class="form-control" type="text" id="phone_format_redactor" value="{{ old('phone_number') }}">
                </div>
                @error('phone_number')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input name="login" class="form-control" type="text" id="login" value="{{ old('login') }}">
                </div>
                @error('login')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mt-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name="password"  class="form-control" type="text" id="password" value="{{ old('password') }}">
                </div>
                @error('password')
                <strong class="text-danger">{{ $message }}</strong>
                @enderror
                <div class="mb-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Роли сотрудника</h5>
                            @foreach(\App\Models\Roles::$roles as  $key => $availableRoles)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $key }}" id="{{ $key }}">
                                    <label class="form-check-label" for="{{ $key }}">
                                        {{ $availableRoles }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <div id="admin_employee_button_generate_password" class="btn btn-primary">Сгенерировать
                        пароль
                    </div>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const passwordInput = document.getElementById("password");
        const buttonToGenerateRandomPassword = document.getElementById('admin_employee_button_generate_password');

        if (buttonToGenerateRandomPassword != null) {
            buttonToGenerateRandomPassword.addEventListener('click', function () {
                if (passwordInput != null) {
                    passwordInput.value = generationPassword(15);
                }
            });
        }
        function generationPassword(length) {
            const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#/*$';
            let password = '';
            for (let i = 0; i < length; i++) {
                let charsetIndex = Math.floor(Math.random() * charset.length);
                password += charset[charsetIndex];
            }
            return password;
        }
    </script>
@endsection
