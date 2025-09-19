<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'scheduled_at',
        'location',
        'user_id',
        'host_id'
    ];

    /**
     * Get the user that created the event.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Alias for user relationship to make the code more expressive
     */
    public function creator()
    {
        return $this->user();
    }

    /**
     * Get the host associated with the event.
     */
    public function host()
    {
        return $this->belongsTo(Host::class);
    }

    /**
     * Get the comments for the event.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
