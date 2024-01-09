<?php

namespace App\Http\Controllers\ScoreType;

use App\Http\Controllers\Controller;
use App\Models\ScoreType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreTypeDeleteController extends Controller
{
    public function delete($id){
        $data = ['is_deleted' => 1];
        DB::table(ScoreType::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
