<?php

namespace App\Http\Controllers\CardType;

use App\Http\Controllers\Controller;
use App\Models\CardTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardTypeDeleteController extends Controller
{
    public function delete($id){
        $data = ['is_deleted' => 1];
        DB::table(CardTypes::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
