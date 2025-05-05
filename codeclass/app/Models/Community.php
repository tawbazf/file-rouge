<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Community extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'member_count',
        'discussion_count'
    ];

    /**
     * Get the members of this community.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_members')
                    ->withPivot('joined_at')
                    ->withTimestamps();
    }

    /**
     * Check if a user is a member of this community
     */
    public function isMember($userId): bool
    {
        return $this->members()->where('user_id', $userId)->exists();
    }
}