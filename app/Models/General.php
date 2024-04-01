<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class General extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["name", "description", "navbar", "footer"];

    protected $fillable = [
      "university_name",
      "description",
      "image",
      "logo",
      "dark_logo",
        "light_logo",
        "navbar",
        "footer"
    ];
}
