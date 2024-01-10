<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'employees';

    public static function updateRolesEmployee($user_employee_id, $roles){
        DB::transaction(function () use ($user_employee_id, $roles){
            DB::table(Employee::$tableName)->where('user_employee_id', $user_employee_id)->delete();
            foreach($roles as $key => $role){
                DB::insert("call insert_employee_by_name_role_and_id_user('$role', $user_employee_id);");
            }
        });
    }

    /**
     * Возвращает параметры
     * | id
     * | first_name
     * | middle_name
     * | phone_number
     * | last_name
     * | login
     * | count_jobs
     * @return \Illuminate\Support\Collection
     */
    public static function getAllEmployeeWithCountJobs(){
        return collect(DB::select('select * from `get_all_employee_with_count_jobs` where `count_jobs` > 0'));

    }
}
