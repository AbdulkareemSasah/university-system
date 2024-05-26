<?php

namespace App\Models;

use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Department extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["name", "slug", "description", "content"];
    protected $fillable = [
        "collage_id",
        "name",
        "slug",
        "description",
        "image",
        "content",
        "properties",
        "visible"
    ];
    protected $casts = [
        'properties' => 'array',
    ];
    public function levels()
    {
        return $this->hasMany(LevelDepartment::class);
    }

    public function collage()
    {
        return $this->belongsTo(Collage::class, 'collage_id');
    }
    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, "department_lecture");
    }


}
