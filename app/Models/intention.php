<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intention extends Model
{
    /** @use HasFactory<\Database\Factories\IntentionFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'intention_text',
        'is_permanent',
        'category',
        'user_id',
        'event_id',
        'type'
    ];

    /**
     * Get the user that created the intention.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that this intention is for.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
