<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
        public function members()
{
    return $this->belongsToMany(User::class, 'community_members')
                ->withPivot('joined_at')
                ->withTimestamps();
}

}