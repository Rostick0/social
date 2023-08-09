<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $fillable = [
        'password',
        'phone',
        'name',
        'surname',
        'patronymic',
        'status',
        'age',
        'photo_id',
        'email',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class, "user_id", "id");
    }
    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class, "user_id", "id");
    }
    public function photo(): BelongsTo
    {
        return $this->belongsTo(File::class, "photo_id", "id");
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
