<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    private $fillable = [
        'title',
        'description',
        'image',
        'is_group',
        'last_message_id',
    ];

    function lastMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'last_message_id', 'id');
    }
}
