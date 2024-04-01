<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "slug",
        "description",
        "image",
        "content",
        "visible"
    ];
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
}
