<?php

namespace App\Http;

use App\Models\User;
use http\Message;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Scalar\String_;


class RedisLogging {

    public const REDIS_VARIABLE_LOG = "sperBankHistory";
    public const REDIS_VARIABLE_LOG_SCORE = "sperBankHistory_Score";
    public const DATA_TIMING_REDIS = "timing";
    public const DATA_USER_LINK_REDIS = 'user_id';
    public const DATA_MESSAGE_REDIS = 'message';
    public const DETAILS_REDIS = 'details';
    private const MAX_LOG_FILES = 100;

    public const VOCABULARY_TO_CHANGE = [
        'add' => 'Добавление',
        'update' => 'Изменние',
        'delete' => 'Удаление',
    ];

    public const VOCABULARY_TO_OBJECTS = [
        'score' => 'Счёта',
        'card' => 'Карты',
        'operation' => 'Операции',
    ];

    /**
     * Функция для формирование понятной для пользователя строки и отправки данных в базу данных Redis.
     * @param $reaction string Описание того какие именно действия производили над объектом.
     * @param $table string Описание объекта над которым производились действия
     * @param $user_id int Первычный ключь таблицы "Пользователи"
     * @return void
     */
    public static function saveLog($reaction, $table, $user_id){
        $data = [
            self::DATA_TIMING_REDIS  => date("Y-m-d H:i:s"),
            self::DATA_USER_LINK_REDIS => $user_id,
            self::DATA_MESSAGE_REDIS => "Произошло ".mb_strtolower(
                self::VOCABULARY_TO_CHANGE[$reaction]
                )." на "."вкладке ".mb_strtolower(
                    self::VOCABULARY_TO_OBJECTS[$table]),
        ];

        $json = json_encode($data, JSON_UNESCAPED_UNICODE);

        Redis::command('RPUSH', [self::REDIS_VARIABLE_LOG, $json]);

        self::cleanLast();
    }

    public static function saveLogScore($reaction, $table, $user_id, $score){
        $data = [
            self::DATA_TIMING_REDIS  => date("Y-m-d H:i:s"),
            self::DATA_USER_LINK_REDIS => $user_id,
            self::DATA_MESSAGE_REDIS => "Произошло ".mb_strtolower(
                    self::VOCABULARY_TO_CHANGE[$reaction]
                )." на "."вкладке ".mb_strtolower(
                    self::VOCABULARY_TO_OBJECTS[$table]),
            self::REDIS_VARIABLE_LOG_SCORE => 'Номер счёта: '.$score->score_number.'; Баланс: '.$score->balance.';'
            .User::getFormatString(User::all()->where('id', $score->user_score_id)->first()),
        ];

        $json = json_encode($data, JSON_UNESCAPED_UNICODE);

        Redis::command('RPUSH', [self::REDIS_VARIABLE_LOG_SCORE, $json]);

        self::cleanLast();
    }

    private static function cleanLast(){
        $lenLogs = Redis::command('LLEN', [RedisLogging::REDIS_VARIABLE_LOG]);
        if($lenLogs > self::MAX_LOG_FILES){
            Redis::command('BLPOP', [RedisLogging::REDIS_VARIABLE_LOG, 0]);
        }
    }

    public static function getLog($path){
        $jsonCollection = is_null($path) ?
            Redis::command('LRange', [self::REDIS_VARIABLE_LOG, 0, -1]) :
            Redis::command('LRange', [$path, 0, -1]);;
        $simpleDict = [];
        foreach($jsonCollection as $json){
            $simpleDict[] = (Object)json_decode($json, JSON_UNESCAPED_UNICODE);
        }
        return collect($simpleDict);
    }

    public static function clearLog(){
        Redis::command('DEL', [self::REDIS_VARIABLE_LOG]);
    }
}
