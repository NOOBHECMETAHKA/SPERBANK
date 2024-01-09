<?php

namespace App\Http\Controllers\ScoreType;

use App\Http\Controllers\Controller;
use App\Models\ScoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreTypeUpdateController extends Controller
{
    public function update($id){
        $data = \request()->validate([
            'name' => 'string|required'
        ]);
        DB::table(ScoreType::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
