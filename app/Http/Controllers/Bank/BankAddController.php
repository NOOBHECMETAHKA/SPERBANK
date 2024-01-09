<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Models\Banks;

use Illuminate\Support\Facades\DB;

class BankAddController extends Controller
{

    public function store(){
        $data = \request()->validate([
           'name' => 'unique:banks|string|required'
        ]);
        DB::table(Banks::$tableName)->insert($data);
        return redirect()->back();
    }
}
