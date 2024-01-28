<?php

namespace App\Http\Controllers\History;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryIndexController extends Controller
{
    public function index(){
        $history = RedisLogging::getLog(null);
        $users = User::all();
        return View('history.index', compact('history', 'users'));
    }
}
