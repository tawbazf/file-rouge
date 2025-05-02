<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'videos',
        'pdfs',
        'level',
        'instructor',
        'instructor_avatar'
    ];

    protected $casts = [
        'videos' => 'array',
        'pdfs' => 'array',
    ];

    // Helper methods to work with the JSON fields
    public function getVideosAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }

    public function getPdfsAttribute($value)
    {
        return $value ? json_decode($value) : [];
    }
}