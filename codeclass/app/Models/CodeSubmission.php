<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'assignment_id', 
        'title',
        'description',
        'status', // 'pending', 'reviewed', 'approved'
    ];

    /**
     * Get the user that owns the code submission.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the assignment that this submission belongs to.
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * Get the files for the code submission.
     */
    public function files()
    {
        return $this->hasMany(CodeFile::class);
    }

    /**
     * Get the comments for the code submission.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}