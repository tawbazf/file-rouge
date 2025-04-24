<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_submission_id',
        'filename',
        'file_path',
        'content',
        'language', 
    ];

    
    public function codeSubmission()
    {
        return $this->belongsTo(CodeSubmission::class);
    }

  
    public function lineComments()
    {
        return $this->hasMany(LineComment::class);
    }
}