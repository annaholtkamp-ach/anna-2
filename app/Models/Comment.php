<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'content',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    /**
     * Get the commentable model for the comment.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that created the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
