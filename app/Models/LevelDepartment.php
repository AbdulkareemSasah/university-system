<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        "level_id",
        "department_id",
        "count_of_student"
    ];
}
