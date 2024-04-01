<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClassRoom extends Model
{
    use HasTranslations;

    use HasFactory;
    public $translatable = ["name", "slug", "description", "content", "visible"];
    protected $fillable = [
        "name",
        "slug",
        "description",
        "image",
        "content",
        "capacity",
        "properties",
        "visible"
    ];
}
