<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'scores';

    private static function generateRandomNumberString($length) {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9); // Генерация случайной цифры от 0 до 9
        }
        return $result;
    }

    public static function insertScoreByFK($score_type_id){
        $data = [
            'score_number' => self::generateRandomNumberString(16),
            'balance' => 0,
            'opening_date' => date("Y-m-d H:i:s"),
            'score_type_id' => $score_type_id,
            'user_score_id' => Auth::user()->getAuthIdentifier(),
        ];
        DB::table(Score::$tableName)->insert($data);
    }

    public static function insertScoreByFKAndByUser($score_type_id, $user_id, $balance){
        $data = [
            'score_number' => self::generateRandomNumberString(16),
            'balance' => $balance,
            'opening_date' => date("Y-m-d H:i:s"),
            'score_type_id' => $score_type_id,
            'user_score_id' => $user_id,
        ];
        DB::table(Score::$tableName)->insert($data);
    }

    public static function getDataToUpdateScoreBalance($card_id){
        return collect(DB::select("call get_data_to_update_score_balance($card_id)"));
    }
}
