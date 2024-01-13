@extends('layouts.app')

@section('content')

<div class="container">
        <form class="d-flex justify-content-center w-100" action="{{ route('main.password.update') }}" method="post">
            @csrf
            <div class="card w-75">
                <div class="card-body">
                    <h4 class="text-center">Смена пароля</h4>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Повтор пароля</label>
                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" value="{{ old('password_confirmation') }}">
                    </div>
                    @error('password')
                    <div class="mb-3 mt-3">
                        <strong class="text-danger">{{ $message }}</strong>
                    </div>
                    @enderror
                    <div class="mb-3 form-check mt-3">
                        <input name="doChangePassword" value="1" class="form-check-input" type="checkbox" id="doChangePassword">
                        <label class="form-check-label" for="doChangePassword">
                            Вы уверены что хотите сменить пароль?
                        </label>
                    </div>
                    <button id="buttonToAgreeChangePassword" class="btn btn-warning" type="submit">Сохранить</button>
                </div>
            </div>
        </form>
    <script>
        const inputPassword = document.getElementById('password');
        const checkInputPassword = document.getElementById('doChangePassword')
        const buttonToAgreeChangePassword = document.getElementById('buttonToAgreeChangePassword');
        if(inputPassword != null && checkInputPassword != null && buttonToAgreeChangePassword != null){
            inputPassword.addEventListener('input', function (){
                let contentInputPassword = inputPassword.value;
                if(contentInputPassword === ""){
                    checkInputPassword.checked = false;
                    buttonToAgreeChangePassword.disabled = true;
                } else{
                    checkInputPassword.checked = true;
                    buttonToAgreeChangePassword.disabled = false;
                }
            });

            checkInputPassword.addEventListener('change', function (event){
                buttonToAgreeChangePassword.disabled = !event.target.checked;
            });
        }
    </script>
</div>

@endsection
