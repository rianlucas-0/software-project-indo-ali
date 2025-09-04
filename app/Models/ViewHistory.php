<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ViewHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'view_history';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'location_id', 
        'viewed_at'
    ];
    
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    /**
     * Get the location that was viewed.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Local::class, 'location_id');
    }

    /**
     * Get the user who viewed the location.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to recent views (last 30 days).
     */
    public function scopeRecent($query)
    {
        return $query->where('viewed_at', '>=', now()->subDays(30));
    }

    /**
     * Scope a query by user ID.
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query by location ID.
     */
    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    /**
     * Check if the view is from today.
     */
    public function getIsTodayAttribute(): bool
    {
        return $this->viewed_at->isToday();
    }

    /**
     * Get the time elapsed since the view.
     */
    public function getTimeElapsedAttribute(): string
    {
        return $this->viewed_at->diffForHumans();
    }
}