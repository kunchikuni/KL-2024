<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, Softdeletes;

    protected $fillable = [
        'width',
        'height',
        'path',
        'filename',
        'mime_type',
        'size',
        'caption'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function likes() 
    {
        return $this->hasMany(Like::class);
    }
}
