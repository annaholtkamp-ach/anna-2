<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    /** @use HasFactory<\Database\Factories\HostFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'bio',
        'user_id'
    ];

    /**
     * Get the user associated with the host.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the events hosted by this host.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
