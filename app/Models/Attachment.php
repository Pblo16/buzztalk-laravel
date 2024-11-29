<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $fillable = [
        'message_id',
        'path',
        'type',
        'name',
        'size'
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
