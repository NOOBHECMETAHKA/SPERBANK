<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\User;
use Illuminate\View\View;

class ScoreIndexController extends Controller
{
    public function index(){
        $scores = Score::all();
        $users = User::all();

        return View('score.index', compact('scores', 'users'));
    }
}
