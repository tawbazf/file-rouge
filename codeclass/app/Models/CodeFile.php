<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CodeFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['filename', 'content', 'language_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function codeSubmission()
    {
        return $this->belongsTo(CodeSubmission::class);
    }

  
    public function lineComments()
    {
        return $this->hasMany(LineComment::class);
    }
}