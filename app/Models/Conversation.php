<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function getNameAttribute($value)
    {
        if ($value) return $value;
        
        $otherUsers = $this->users->where('id', '!=', auth()->id());
        return $otherUsers->pluck('name')->join(', ');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
