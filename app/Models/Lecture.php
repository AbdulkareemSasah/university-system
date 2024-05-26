<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Lecture extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ["content"];
    protected $casts = [
        'properties' => 'array',
    ];
    protected $fillable = [
        "table_id",
        "doctor_id",
        "subject_id",
        "level_id",
        'properties',
        'content',
        'visible',
        'start',
        'end',
        'day',
        "class_room_id",
        "type"
    ];
    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function classRoom() : BelongsTo
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function doctor() : BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function subject() : BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    public function level() : BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
    public function departments() : BelongsToMany
    {
        return $this->belongsToMany(Department::class, "department_lecture");
    }
}
