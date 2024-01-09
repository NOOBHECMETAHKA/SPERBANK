<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Banks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankUpdateController extends Controller
{
    public function update($id){
        $data = \request()->validate([
            'name' => 'string|required'
        ]);
        DB::table(Banks::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
