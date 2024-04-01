<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
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
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(User::class);
    }
}
