@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата</th>
                <th scope="col">Редактор</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($history as $key => $rowElement)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $rowElement->timing }}</td>
                    <td>{{ \App\Models\User::getFormatString($users->where('id', $rowElement->user_id)->first()) }}</td>
                    <td>{{ $rowElement->message }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
