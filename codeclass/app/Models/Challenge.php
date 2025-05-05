<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'status',
    ];

    // The user (teacher or creator) who owns the challenge
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Les utilisateurs qui participent à ce challenge
    public function participants()
    {
        return $this->belongsToMany(User::class, 'challenge_participants')
                    ->withPivot('status', 'joined_at')
                    ->withTimestamps();
    }
    
    // Vérifier si un utilisateur participe déjà à ce challenge
    public function hasParticipant($userId)
    {
        return $this->participants()->where('user_id', $userId)->exists();
    }
}