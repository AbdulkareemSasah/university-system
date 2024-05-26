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
    protected $casts = [
        'properties' => 'array',
    ];
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, "lectures");
    }
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, "lectures");
    }
    public function departments()
    {
        return $this->hasMany(LevelDepartment::class);
    }

}
