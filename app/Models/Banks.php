<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banks extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'banks';

    public static function getStatistic(){
        return collect(DB::select("call get_statistic_banks()"));
    }
}
