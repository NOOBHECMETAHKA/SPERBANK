<?php

namespace App\Http\Controllers\CardType;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardType\CardTypeIndexRequest;
use App\Models\CardTypes;
use Illuminate\Http\Request;

class CardTypeIndexController extends Controller
{
    public function index(CardTypeIndexRequest $request){
        $data = $request->validated();
        $cardTypes = CardTypes::query();

        $cardTypes->where('is_deleted', 0);

        if(isset($data['name'])){
            $cardTypes->where('name', $data['name']);
        }

        $cardTypes = $cardTypes->paginate(9);
        return View('card_types.index', compact('cardTypes'));
    }
}
