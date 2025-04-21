<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'progress',
        'time_remaining',
        'teacher_id',
    ];
    public function users()
{
    return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
        ->withPivot('assigned_by')
        ->withTimestamps();
}
public function students()
{
    return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
        ->where('role', 'user')
        ->withPivot('assigned_by')
        ->withTimestamps();
}
}