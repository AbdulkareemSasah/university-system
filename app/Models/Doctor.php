<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Doctor  extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $guarded = "doctor";
    protected $guard = "doctor";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "avatar",
        "degree",
        "days_available"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            "days_available" => "array"
        ];
    }


    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, "lectures");
    }
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }
    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class, "lectures");
    }



    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() == 'doctor') {
            return true;
        }
        return false;
    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar;
    }
}
