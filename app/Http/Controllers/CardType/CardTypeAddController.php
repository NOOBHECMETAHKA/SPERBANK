<?php

namespace App\Http\Controllers\CardType;

use App\Http\Controllers\Controller;
use App\Models\CardTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardTypeAddController extends Controller
{
    public function store(){
        $data = \request()->validate([
            'name' => 'unique:card_types|string|required'
        ]);
        DB::table(CardTypes::$tableName)->insert($data);
        return redirect()->back();
    }
}
