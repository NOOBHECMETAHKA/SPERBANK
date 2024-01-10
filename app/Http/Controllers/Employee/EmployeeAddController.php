<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeAddController extends Controller
{
    public function add(){
        return View('employee.add');
    }
    public function store(){
        $data = \request()->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => '',
        ]);
        $data['password'] = Hash::make($data['password']);
        $roles = $data['roles'];
        unset($data['roles']);
        $id_user = DB::table(User::$tableName)->insertGetId($data);
        Employee::updateRolesEmployee($id_user, $roles);
        return redirect()->route('employee.index');
    }
}
