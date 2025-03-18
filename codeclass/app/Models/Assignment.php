<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'created_by', // user_id of the teacher
        'status', // 'draft', 'published', 'archived'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
    ];

    /**
     * Get the teacher who created the assignment.
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the code submissions for this assignment.
     */
    public function codeSubmissions()
    {
        return $this->hasMany(CodeSubmission::class);
    }
}