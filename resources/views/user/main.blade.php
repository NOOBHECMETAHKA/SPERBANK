@extends('layouts.app')

@section('content')
    {{--    Modal score--}}
    <div class="modal fade" id="create-score" tabindex="-1" aria-labelledby="create-score" aria-hidden="true">
        <form action="{{ route('score.store') }}" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание счёта</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="score_type_id" class="form-label">выберите тип счёта:</label>
                            <select name="score_type_id" class="form-select" id="score_type_id">
                                @foreach($score_types as $score_type)
                                    <option value="{{ $score_type->id }}">{{ $score_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark">Создать</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{--Modal card--}}
    <div class="modal fade" id="create-card" tabindex="-1" aria-labelledby="create-card" aria-hidden="true">
        <form action="{{ route('card.store') }}" method="post">@csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание карту</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="card_score_id" class="form-label">Выберите счёт:</label>
                            <select name="card_score_id" class="form-select" id="card_score_id">
                                @foreach($scores as $score)
                                    <option value="{{ $score->id }}">{{ $score->score_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bank_id" class="form-label">Выберите банк:</label>
                            <select name="bank_id" class="form-select" id="bank_id">
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="card_type_id" class="form-label">Выберите тип карты:</label>
                            <select name="card_type_id" class="form-select" id="card_type_id">
                                @foreach($card_types as $card_type)
                                    <option value="{{ $card_type->id }}">{{ $card_type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark">Создать</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{--Modal operation--}}
    <div class="modal fade" id="create-operation" tabindex="-1" aria-labelledby="create-operation" aria-hidden="true">
        <form action="{{ route('operation.store') }}" method="post"> @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Создание операция</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="accrualAmountInput" class="form-label">Сумма операции</label>
                            <input name="accrual_amount" type="number" class="form-control" id="accrualAmountInput">
                            @error('accrual_amount')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Причина операции</label>
                            <textarea name="description" class="form-control" id="descriptionInput" rows="3"></textarea>
                            @error('description')
                            <span class="alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="card_operation_id" class="form-label">Выберите карту:</label>
                            <select name="card_operation_id" class="form-select" id="card_operation_id">
                                @foreach($cards as $card)
                                    <option value="{{ $card->id }}">{{ $card->card_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="operation_type_id" class="form-label">Выберите Тип операции:</label>
                            <select name="operation_type_id" class="form-select" id="operation_type_id">
                                @foreach($operation_types as $operation_type)
                                    <option value="{{ $operation_type->id }}">{{ $operation_type->name }}</option>
                                @endforeach
                            </select>
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
        {{--    Операции--}}
        <div class="d-flex justify-content-center">
            <div class="card w-100">
                <div class="card-body">
                    <h1 class="text-center" id="__link_operation__">Операции</h1>
                    @if(count($operations) > 0 and count($cards) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Сумма операции</th>
                                <th scope="col">Описание операции</th>
                                <th scope="col">Дата операции</th>
                                <th scope="col">Карты</th>
                                <th scope="col">Тип операции</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($operations as $operation)
                                <tr>
                                    <td>{{ $operation->id }}</td>
                                    @if($operation->accrual_amount >= 0)
                                        <td class="text-success">+{{ $operation->accrual_amount }} рублей</td>
                                    @else
                                        <td class="text-danger">{{ $operation->accrual_amount }} рублей</td>
                                    @endif
                                    <td>{{ $operation->description }}</td>
                                    <td>{{ $operation->created_at }}</td>
                                    <td>{{ $cards->where('id', $operation->card_operation_id)->first()->card_number }}</td>
                                    <td>{{ $operation_types->where('id', $operation->operation_type_id)->first()->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger">
                            <strong>Операции отсуствуют!</strong> Чтобы создать операцию потребуется карта!
                        </div>
                    @endif
                    @if(count($cards) > 0)
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#create-operation">
                            Создать операцию
                        </button>
                    @endif
                </div>
            </div>
        </div>
        {{--    Конец операции--}}
        {{--    Карта--}}
        <div class="d-flex justify-content-center mt-3">
            <div class="card w-100">
                <div class="card-body">
                    <h1 class="text-center" id="__link_cards__">Карты</h1>
                    @if(count($cards) > 0)
                        <div class="w-100 d-flex flex-row flex-wrap justify-content-around">
                            {{--                    Карта банка--}}
                            @foreach($cards as $card)
                                <div class="mt-3 card __card_bank__main_card">
                                    <div class="card-body __card_bank__main_image">
                                        <h3>{{ $banks->where('id', $card->bank_id)->first()->name }}</h3>
                                        <div class="__card_bank__chip_block bg-warning mt-5"></div>
                                        <div class="w-100 d-lg-flex gap-3">
                                            @foreach(\App\Models\Card::splitStringForCard($card->card_number) as $elementOfNumberCard)
                                                <p class="mt-1 fs-4">{{ $elementOfNumberCard }}</p>
                                            @endforeach
                                        </div>
                                        <div
                                            class="w-75 d-flex justify-content-center flex-row align-items-center gap-3">
                                            <p>VALID<br>THRU</p>
                                            <p>{!! $card->ending_date !!}</p>
                                        </div>
                                        <div class="w-100 d-flex justify-content-between mt-1 align-items-center">
                                            <span class="fs-5">{{ $card->owner }}</span>
                                            <span
                                                class=" fs-5 text-end">{{ $card_types->where('id', $card->card_type_id)->first()->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{--                   конец Карты банка--}}
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <strong>Карты отсуствуют!</strong> Чтобы создать карту потребуется счёт!
                        </div>
                    @endif
                    @if(count($scores) > 0)
                        <div class="mb-3 mt-3">
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#create-card">
                                Создать карту
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        {{--    Конец карты--}}
        {{--    Счёта--}}
        <div class="d-flex justify-content-center mt-3">
            <div class="card w-75">
                <div class="card-body">
                    <h1 class="text-center" id="__link_score__">Счёта</h1>
                    @if(count($scores) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Номер счёта</th>
                                <th scope="col">Баланс</th>
                                <th scope="col">Тип счёта</th>
                                <th scope="col">Дата открытия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scores as $score)
                                <tr>
                                    <td>{{ $score->score_number }}</td>
                                    <td>{{ $score->balance.' рублей' }}</td>
                                    <td>{{ $card_types->where('id', $score->score_type_id)->first()->name }}</td>
                                    <td>{{ $score->opening_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-danger">
                            <strong>Счёта отсуствуют!</strong>
                        </div>
                    @endif
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                            data-bs-target="#create-score">
                        Создать счёт
                    </button>
                </div>
            </div>
        </div>
        {{--    конец счёта--}}
    </div>
@endsection
