<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'status',
    ];

    // The user (teacher or creator) who owns the challenge
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}