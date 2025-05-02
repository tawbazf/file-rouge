<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeFile extends Model
{
    protected $table = 'code_files'; // Make sure this matches your table name
    
    protected $fillable = ['filename', 'content', 'language', 'file_path', 'code_submission_id'];



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