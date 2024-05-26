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
        "properties",
        "has_practical"
    ];
    protected $casts = [
        'properties' => 'array',
    ];
    public function levels()
    {
        return $this->belongsToMany(Level::class, "lectures");
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, "lectures");
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
