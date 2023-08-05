<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'gallery';

    protected $guarded = [];

    protected $fillable = [
        'likes',
        'comments',
        'views',
        'user_id',
        'photo_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function photo(): BelongsTo
    {
        return $this->belongsTo(File::class, "photo_id", "id");
    }
}
