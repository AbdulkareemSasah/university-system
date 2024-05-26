<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Collage extends Model
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
        "properties",
        "visible"
    ];
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
    protected $casts = [
        'properties' => 'array',
    ];
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function tables()
    {
        return $this->hasMany(Table::class);
    }

}
