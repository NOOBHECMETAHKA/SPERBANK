<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeIndexRequest;
use App\Models\Employee;
use App\Models\Roles;

class EmployeeIndexController extends Controller
{
    public function index(EmployeeIndexRequest $request){
        $data = $request->validated();
        $employees = Employee::getAllEmployeeWithCountJobs();
        $roles = Roles::getUsersJob($employees);

        if(isset($data['login']))
            $employees = $employees->where('login', $data['login']);


        return View('employee.index', compact('employees', 'roles'));
    }
}
