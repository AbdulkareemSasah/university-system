<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Table extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["data"];
    protected $fillable = [
        "collage_id",
        "year_id",
        "term_id",
        "properties",
        "data"
    ];
    protected $casts = [
        'properties' => 'array',
    ];

    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function year()
    {
        return $this->belongsTo(Year::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
