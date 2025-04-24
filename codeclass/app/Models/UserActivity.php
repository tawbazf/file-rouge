<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id', 'type', 'related_id', 'related_type', 'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}