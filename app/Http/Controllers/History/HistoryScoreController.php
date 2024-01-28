<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryScoreController extends Controller
{
    public function index(){
        $history = RedisLogging::getLog(RedisLogging::REDIS_VARIABLE_LOG_SCORE);
        $users = User::all();
        return View('history.score-index', compact('history', 'users'));
    }
}
