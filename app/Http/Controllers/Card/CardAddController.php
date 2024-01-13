<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardAddController extends Controller
{
    public function store(){
        $data = \request()->validate([
            'card_score_id' => 'int|required',
            'card_type_id' => 'int|required',
            'bank_id' => 'int|required',
        ]);
        Card::insertCardByFK($data['bank_id'], $data['card_score_id'], $data['card_type_id']);

        RedisLogging::saveLog(
            'add',
            'card',
            Auth::user()->getAuthIdentifier()
        );

        return redirect()->back();
    }
}
