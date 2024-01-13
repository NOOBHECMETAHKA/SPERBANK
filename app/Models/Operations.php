<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Operations extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'operations';

    public static function getOperationsByUserId(){
        $user_id = Auth::user()->getAuthIdentifier();
        return collect(DB::select("call get_all_operations_by_card_id($user_id)"));
    }

    public static function getOperationsByCardsData($cards){
        $operations = [];
        DB::transaction(function() use($cards, $operations){
            foreach($cards as $card){
                $operations[] = self::getOperationsByCardId($card->id);
            }
        });

        return $operations;
    }
}
