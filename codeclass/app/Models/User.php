<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // 'student', 'teacher,
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the code submissions for the user.
     */
    public function codeSubmissions()
    {
        return $this->hasMany(CodeSubmission::class);
    }

    /**
     * Get the comments created by the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the badges earned by the user.
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('awarded_at')
            ->withTimestamps();
    }
    

    /**
     * Check if the user is a teacher.
     */
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
    // Projects assigned to the user (as student)
public function assignedProjects()
{
    return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id')
        ->withPivot('assigned_by')
        ->withTimestamps();
}

// Courses assigned to the user (as student)
public function assignedCourses()
{
    return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
        ->withPivot('assigned_by')
        ->withTimestamps();
}

// Projects assigned by the teacher
public function projectsAssigned()
{
    return $this->hasManyThrough(Project::class, 'project_user', 'assigned_by', 'id', 'id', 'project_id');
}

// Courses assigned by the teacher
public function coursesAssigned()
{
    return $this->hasManyThrough(Course::class, 'course_user', 'assigned_by', 'id', 'id', 'course_id');
}
public function skills()
{
    return $this->belongsToMany(Skill::class)->withPivot('level')->withTimestamps();
}
}