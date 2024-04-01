<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ["name", "slug", "description", "content"];
    protected $fillable = [
        "name",
        "slug",
        "description",
        "image",
        "content",
        "visible",
        "properties"
    ];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(User::class);
    }

}
