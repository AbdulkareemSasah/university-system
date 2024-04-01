<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ["name", "slug"];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
