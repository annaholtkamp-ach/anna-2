<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $guarded = [];

    public function organiser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function intention()
    {
        return $this->hasMany(Intention::class);
    }

    public function canEditOrDelete(User $user): bool
    {
        // Admin users can always edit and delete all articles
        if($user->isAdmin()) {
            return true;
        }

        // Only the author can delete or edit his/her article
        if($this->user_id !== $user->id) {
            return false;
        }

        return true;
    }
}
