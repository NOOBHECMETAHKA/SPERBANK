<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Banks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankDeleteController extends Controller
{
    public function delete($id){
        $data = ['is_deleted' => 1];
        DB::table(Banks::$tableName)->where('id', $id)->update($data);
        return redirect()->back();
    }
}
