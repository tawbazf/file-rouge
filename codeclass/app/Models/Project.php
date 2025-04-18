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
    ];
    public function users()
{
    return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id')
        ->withPivot('assigned_by')
        ->withTimestamps();
}
}