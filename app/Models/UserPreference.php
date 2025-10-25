<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'preferred_categories',
        'preferred_features',
        'preferred_state',
        'budget_range',
    ];

    protected $casts = [
        'preferred_categories' => 'array',
        'preferred_features'   => 'array',
        'preferred_state'     => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}


