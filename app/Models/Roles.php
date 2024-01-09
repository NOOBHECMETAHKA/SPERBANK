<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'roles';

    public static $roles = [
        'admin' => 'Администратор',
        'accountant' => 'Бугалтер'
    ];

    public static function makeSeedInfo(){
        $seeder_roles = [];
        foreach(array_keys(self::$roles) as $key_role){
            $seeder_roles[] =   ['name' => $key_role];
        }
        return $seeder_roles;
    }
//\Illuminate\Support\Collection
    public static function getUsersJob( $data){
        $info = [];
        if($data instanceof \Illuminate\Support\Collection){
            $info = DB::transaction(function() use($data){
                $employees = [];
                foreach($data as $employee){
                    $employees[$employee->id] = DB::select("call `get_roles_user_by_id`(".$employee->id.")");
                }
                return $employees;
            });
        } else {
            $info = DB::select("call `get_roles_user_by_id`(".$data->id.")");
        }

        return collect($info);
    }
}
