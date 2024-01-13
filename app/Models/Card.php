<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Card extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'cards';

    private static function generateRandomNumberString($length) {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9); // Генерация случайной цифры от 0 до 9
        }
        return $result;
    }

    public static function splitStringForCard($inputString) {
        return str_split($inputString, 4);
    }

    private static function getDateInThreeYearsFormat() {
        $date = date_create(); // Создаем объект даты с текущей датой и временем
        date_add($date, date_interval_create_from_date_string('3 years')); // Добавляем 3 года к текущей дате

        $formattedDate = date_format($date, 'm/y'); // Форматируем дату в виде "месяц/год"

        return $formattedDate;
    }

    public static function getUserCardsByUserID($user_id){
        return collect(DB::select("call get_all_card_by_user_id($user_id);"));
    }

    public static function getUserCountCardsByUserID($user_id){
        return count(DB::select("call get_all_card_by_user_id($user_id);"));
    }

    public static function getCard(){
        return collect(DB::select("select * from getCard;"));
    }

    public static function insertCardByFK($bank_id, $score_id, $card_type_id){
        $user = Auth::user();
        $card_code =  self::generateRandomNumberString(16);
        $year_format = self::getDateInThreeYearsFormat();
        $user_name = $user->first_name.' '.$user->middle_name;
        $data = [
            'owner' => $user_name,
            'card_number' => $card_code,
            'ending_date' => $year_format,
            'CCV_code' => self::generateRandomNumberString(3),
            'card_score_id' => $score_id,
            'card_type_id' => $card_type_id,
            'bank_id' => $bank_id,
        ];
        DB::table(Card::$tableName)->insert($data);
    }
}
