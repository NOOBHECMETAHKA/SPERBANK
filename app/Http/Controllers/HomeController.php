<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use App\Models\Card;
use App\Models\CardTypes;
use App\Models\Operations;
use App\Models\OperationTypes;
use App\Models\Score;
use App\Models\ScoreType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $statistics = Banks::getStatistic();
        return view('home', compact('statistics'));
    }

    public function config(){
        $this->middleware('auth');
        $user_id = Auth::user()->getAuthIdentifier();

        $scores = Score::all()->where('user_score_id', $user_id); //Используется
        $score_types = ScoreType::all();
        $banks = Banks::all();
        $card_types = CardTypes::all();
        $cards = Card::getUserCardsByUserID($user_id); //Используется
        $operation_types = OperationTypes::all();

        $operations = Operations::getOperationsByUserId(); //Используется


        return View('user.main', compact('score_types',
            'scores', 'banks', 'card_types', 'cards', 'operations', 'operation_types'));
    }
    public function profile(){
        $this->middleware('auth');
        $user = Auth::user();

        return View('user.profile', compact('user'));
    }
    public function update(){
        $this->middleware('auth');
        $data = \request()->validate([
            'first_name' => 'string|required|max:255|min:3',
            'middle_name' => 'string|required|max:255|min:3',
            'last_name' => 'string',
            'phone_number' => 'string|required|max:255|min:3',
        ]);

        DB::table(User::$tableName)->where('id', Auth::user()->getAuthIdentifier())->update($data);

        return redirect()->route('main.configuration');
    }

    public function editPassword(){
        $this->middleware('auth');
        return View('user.change_password');
    }

    public function updatePassword(){
        $this->middleware('auth');
        $data = \request()->validate([
            'doChangePassword' => '',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if(!isset($data['doChangePassword'])){
            unset($data['password']);
        } else{
            $data['password'] = Hash::make($data['password']);
        }

        unset($data['doChangePassword']);

        DB::table(User::$tableName)->where('id', Auth::user()->getAuthIdentifier())->update($data);

        return redirect()->route('main.configuration');
    }


}
