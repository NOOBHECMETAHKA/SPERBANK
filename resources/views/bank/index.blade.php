@extends('layouts.app-admin')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{ route('bank.store') }}" method="post"> @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление банка</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="name-bank">Наименование банка</label>
                    <input id="name-bank" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required type="text" placeholder="Наименование банка">
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
         <h1 class="text-center">Банки</h1>
         <form method="get" action="{{ route('bank.index') }}">
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
                     <th scope="col" colspan="3">Наименование банка</th>
                 </tr>
                 </thead>
                 <tbody>
                 @foreach($banks as $key => $bank)
                     <tr>
                         <th>{{$key + 1}}</th>
                         <td>{{$bank->name}}</td>

                         <td>
                             <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-modal-window-{{ $bank->id }}">
                                 Изменить
                             </button>
                             <div class="modal fade" id="update-modal-window-{{ $bank->id }}" tabindex="-1" aria-hidden="true">
                                 <form action="{{ route('bank.update', ['id' => $bank->id]) }}" method="post"> @csrf
                                     <div class="modal-dialog">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение банка</h1>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body">
                                                 <label class="form-label" for="name-bank">Наименование банка</label>
                                                 <input id="name-bank" name="name" class="form-control" type="text" placeholder="Наименование банка" value="{{ $bank->name }}">
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
                             <form action="{{ route('bank.delete', ['id' => $bank->id]) }}" method="post"> @csrf
                                 <button class="btn btn-danger" type="submit">Удалить!</button>
                             </form>
                         </td>
                     </tr>
                 @endforeach
                 </tbody>
             </table>
         </div>
         <div>{{ $banks->links() }}</div>
     </div>
@endsection
