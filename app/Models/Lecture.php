<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lecture extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["content"];

    protected $fillable = [
        "table_id",
        "subject_level_doctor_id",
        'properties',
        'content',
        'visible'
    ];
}
