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
        'name',
        'surname',
        'patronymic',
        'status',
        'age',
        'file_id',
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
    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, "user_id", "id");
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
