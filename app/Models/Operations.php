<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    use HasFactory;
    protected $guarded = false;
    public static $tableName = 'operations';
}