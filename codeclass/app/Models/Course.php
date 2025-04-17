<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
{
    return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
        ->withPivot('assigned_by')
        ->withTimestamps();
}
}
