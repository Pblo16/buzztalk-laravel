<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'media_path',
        'media_type',
        'caption'
    ];

    protected $appends = ['media_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMediaUrlAttribute()
    {
        return $this->media_path ? asset('storage/' . $this->media_path) : null;
    }
}
