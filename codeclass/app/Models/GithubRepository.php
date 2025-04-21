<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubRepository extends Model
{
use HasFactory;

protected $fillable = [
'project_id',
'student_id',
'name',
'url',
'status',
];

public function project() {
    return $this->belongsTo(Project::class, 'project_id');
}
public function student() {
    return $this->belongsTo(User::class, 'student_id');
}
}