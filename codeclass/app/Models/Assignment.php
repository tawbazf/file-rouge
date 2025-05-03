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
        'created_by',
        'status', 
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'datetime',
    ];

    
    public function teacher()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function codeSubmissions()
    {
        return $this->hasMany(CodeSubmission::class);
    }
    public function students()
{
    return $this->belongsToMany(User::class, 'assignment_user', 'assignment_id', 'user_id');
}

}