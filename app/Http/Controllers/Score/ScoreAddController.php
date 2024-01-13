<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\Score;
use App\Models\ScoreType;
use Illuminate\Support\Facades\Auth;

class ScoreAddController extends Controller
{
    public function store(){
        $data = request()->validate([
           'score_type_id' => 'int'
        ]);

        Score::insertScoreByFK($data['score_type_id']);
        return redirect()->back();
    }

    public function storeAdmin(){
        $data = request()->validate([
            'score_type_id' => 'int|required',
            'user_score_id' => 'int|required',
            'balance' => 'decimal:2|required'
        ]);

        Score::insertScoreByFKAndByUser($data['score_type_id'], $data['user_score_id'], $data['balance']);

        RedisLogging::saveLog(
            'add',
            'score',
            Auth::user()->getAuthIdentifier()
        );
        return redirect()->back();
    }
}
