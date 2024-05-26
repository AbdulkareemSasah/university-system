<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Term extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["name", "slug", "description", "content"];
    protected $fillable = [
        "name",
        "year_id",
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
    public function year()
    {
        return $this->belongsTo(Year::class);
    }
    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
