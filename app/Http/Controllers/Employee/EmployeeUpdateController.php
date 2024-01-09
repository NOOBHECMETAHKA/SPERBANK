<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeUpdateController extends Controller
{
    public function edit($id){
        $user = User::all()->where('id', $id)->first();
        $roles = Roles::getUsersJob($user);
        return View('employee.edit', compact('user', 'roles'));
    }
    public function update($id){
        $data = \request()->validate([

        ]);
    }
}
