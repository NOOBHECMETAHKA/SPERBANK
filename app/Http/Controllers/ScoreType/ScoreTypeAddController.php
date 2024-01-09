<?php

namespace App\Http\Controllers\ScoreType;

use App\Http\Controllers\Controller;
use App\Models\ScoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreTypeAddController extends Controller
{
    public function store(){
        $data = \request()->validate([
            'name' => 'unique:score_types|string|required'
        ]);
        DB::table(ScoreType::$tableName)->insert($data);
        return redirect()->back();
    }
}
