<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playdate extends Model
{
    /** @use HasFactory<\Database\Factories\PlaydateFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'location',
        'user_id'
    ];

    /**
     * Get the user that created the playdate.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the playdate.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
