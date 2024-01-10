<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeUpdateController extends Controller
{
    public function edit($id){
        $user = User::all()->where('id', $id)->first();
        $roles = Roles::getUsersJob($user);
        return View('employee.edit', compact('user', 'roles'));
    }
    public function update($id){
        $data = \request()->validate([
            'first_name' => 'string',
            'middle_name' => 'string',
            'last_name' => 'string',
            'phone_number' => 'string',
            'roles' => ''
        ]);

        Employee::updateRolesEmployee($id, $data['roles']);
        unset($data['roles']);
        DB::table(User::$tableName)->where('id', $id)->update($data);
        return redirect()->route('employee.index');
    }
}
