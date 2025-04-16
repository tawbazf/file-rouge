<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeReview extends Model
{
    protected $fillable = ['filename', 'code', 'user_id'];

    public function comments()
    {
        return $this->hasMany(CodeReviewComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}