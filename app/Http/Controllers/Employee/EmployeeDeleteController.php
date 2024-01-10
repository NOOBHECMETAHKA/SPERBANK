<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Http\Request;

class EmployeeDeleteController extends Controller
{
    public function delete($id){
        Roles::makeSeedInfo($id);
        return redirect()->back();
    }
}
