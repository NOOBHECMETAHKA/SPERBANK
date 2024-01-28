<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccountantMiddleware
{
    private $protected_role = 'accountant';

    public function handle(Request $request, Closure $next): Response
    {
        $user_id = Auth::user()->getAuthIdentifier() ?? "";
        if($user_id == ""){
            return redirect()->route('home');
        } else{
            $roles = User::getRoleUserByName($this->protected_role, $user_id);
            if(count($roles) == 0){
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
