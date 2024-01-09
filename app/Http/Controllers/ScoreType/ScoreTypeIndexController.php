<?php

namespace App\Http\Controllers\ScoreType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreType\ScoreTypeIndexRequest;
use App\Models\ScoreType;
use Illuminate\Http\Request;

class ScoreTypeIndexController extends Controller
{

    public function index(ScoreTypeIndexRequest $request){
        $data = $request->validated();
        $scoreType = ScoreType::query();

        $scoreType->where('is_deleted', 0);

        if(isset($data['name'])){
            $scoreType->where('name', $data['name']);
        }

        $scoreType = $scoreType->paginate(9);
        return View('score_types.index', compact('scoreType'));
    }
}
