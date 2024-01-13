<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Http\RedisLogging;
use App\Models\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OperationAddController extends Controller
{
    public function store(){
        $data = \request()->validate([
            'accrual_amount' => 'required',
            'description' => 'required',
            'operation_type_id' => 'required|int',
            'card_operation_id' => 'required|int',
        ]);

        if(!isset($data['description'])){
            $data['description'] = "Отсуствует";
        }

        RedisLogging::saveLog(
            'add',
            'operation',
            Auth::user()->getAuthIdentifier()
        );

        DB::table(Operations::$tableName)->insert($data);

        return redirect()->back();
    }
}
