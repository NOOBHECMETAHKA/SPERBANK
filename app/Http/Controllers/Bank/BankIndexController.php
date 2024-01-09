<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bank\BankIndexRequest;
use App\Models\Banks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BankIndexController extends Controller
{
    public function index(BankIndexRequest $request){
        $data = $request->validated();
        $banks = Banks::query();

        $banks->where('is_deleted', 0);

        if(isset($data['name'])){
            $banks->where('name', $data['name']);
        }

        $banks = $banks->paginate(9);
        return View('bank.index', compact('banks'));
    }

}
