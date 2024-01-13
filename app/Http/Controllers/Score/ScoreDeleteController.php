<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScoreDeleteController extends Controller
{
    public function delete($id){
        $score = Score::all()->where('id', $id)->first();
        DB::table(Score::$tableName)->where('id', $id)->delete();
        //Логирование
        RedisLogging::saveLogScore(
            'delete',
            'score',
            Auth::user()->getAuthIdentifier(),
            $score
        );
        return redirect()->back();
    }
}
