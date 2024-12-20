<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $fillable = ['name'];
    protected $with = ['users', 'lastMessage'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function isIndividual(): bool
    {
        return $this->users()->count() === 2;
    }

    public function getNameAttribute($value)
    {
        if ($value) return $value;
        if ($this->isIndividual()) {
            return $this->users
                ->where('id', '!=', auth()->user()?->id)
                ->first()
                ->name;
        }
        return 'Group Chat';
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['users'] = $this->users->toArray();
        $array['last_message'] = $this->lastMessage?->toArray();
        return $array;
    }
}
