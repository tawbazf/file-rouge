<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeReviewComment extends Model
{
    protected $fillable = ['code_review_id', 'user_id', 'tag', 'comment'];

    public function codeReview()
    {
        return $this->belongsTo(CodeReview::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}