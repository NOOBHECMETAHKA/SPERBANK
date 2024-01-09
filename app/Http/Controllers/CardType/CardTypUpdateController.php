<?php

namespace App\Http\Controllers\CardType;

use App\Http\Controllers\Controller;
use App\Models\CardTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardTypUpdateController extends Controller
{
    public function update($id){
        $data = \request()->validate([
            'name' => 'string|required'
        ]);
        DB::table(CardTypes::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
