<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class intention extends Model
{
    /** @use HasFactory<\Database\Factories\IntentionFactory> */
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(event::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(User::class, 'event_id');
}
}
