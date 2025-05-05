<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunityMember extends Model
{
    protected $fillable = [
        'user_id',
        'community_id',
        'joined_at'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /**
     * Get the user that belongs to this membership.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the community that this membership belongs to.
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
}