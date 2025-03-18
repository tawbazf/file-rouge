<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineComment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'code_file_id',
        'line_number',
        'content',
        'category', // 'functionality', 'performance', 'style'
    ];

    /**
     * Get the user that owns the line comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the code file that owns the line comment.
     */
    public function codeFile()
    {
        return $this->belongsTo(CodeFile::class);
    }
}