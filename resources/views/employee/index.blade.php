@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <h1 class="text-center">Сотрудникики</h1>
        <form method="get" action="{{ route('employee.index') }}" class="mt-3">
            <div class="input-group mb-3 ">
                <input name="login" class="form-control" placeholder="Поиск по наименованию" id="findButton"
                       aria-label="" type="text">
                <button class="btn btn-primary" type="submit">Найти</button>
            </div>
        </form>

        <table class="table mt-3">
            <thead>
                <th class="col">#</th>
                <th class="col">Имя</th>
                <th class="col">Номер телефона</th>
                <th class="col">Логин</th>
                <th class="col" colspan="3">Роли</th>
            </thead>
            <tbody>
                @foreach($employees as $key => $employee)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name }}</td>
                        <td>{{ $employee->phone_number }}</td>
                        <td>{{ $employee->login }}</td>
                        <td>
                           @foreach($roles[$employee->id] as $role)
                            ›{{ App\Models\Roles::$roles[$role->name] }}
                           @endforeach
                        </td>
                        <td>
                            <a href="" class="btn btn-warning">Отредактировать</a>
                        </td>
                        <td>
                            <a href="" class="btn btn-danger">Уволить</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
