@extends('layouts.app')

@section('content')
<div class="container">
    <div class="rounded">
        <img src="{{ asset('images/sqwozbaba.png') }}" alt="" class="w-100">
    </div>
</div>

<div class="container mt-5">
    <div class="w-100 d-flex align-items-center flex-column">
        <h1 class="text-center">Графики</h1>
        <div class="w-75">
            <p class="mt-0 fs-5 text-start"><span class="text-dark fw-bold fs-3">#</span> Что показывает статистика? <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Помощь</a></p>
        </div>
        <div class="collapse w-75" id="collapseExample">
            <p><span class="text-danger fw-bold fs-3">?</span> График показывает процентное соотношение банков к картам которые завели пользователи сайте.</p>
        </div>
        <div class="simple-bar-chart w-75 mt-1">
            @foreach($statistics as $el)
                <div class="item" style="--clr: #069CDB; --val: {{ $el->procent}}">
                    <div class="label">{{ $el->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
