<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeFile extends Model
{
    protected $table = 'code_files';
    
    protected $fillable = ['filename', 'content', 'language', 'file_path', 'code_submission_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function submission()
    {
        return $this->belongsTo(CodeSubmission::class, 'code_submission_id');
    }


  
    public function lineComments()
    {
        return $this->hasMany(LineComment::class);
    }
}