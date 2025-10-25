<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'locations';


    protected $fillable = [
        'title',
        'category',
        'description',
        'images',
        'features',
        'working_hours',
        'is_active',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'working_hours' => 'array',
    ];
    
    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'first_image',
        'formatted_working_hours',
        'week_days'
    ];

    /**
     * Days of the week in Portuguese with abbreviations
     */
    protected const DAYS_OF_WEEK = [
        'segunda' => 'Seg',
        'terça' => 'Ter', 
        'quarta' => 'Qua',
        'quinta' => 'Qui',
        'sexta' => 'Sex',
        'sábado' => 'Sáb',
        'domingo' => 'Dom'
    ];

    /**
     * Day order for consecutive day checking
     */
    protected const DAY_ORDER = [
        'segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo'
    ];

    /**
     * Default image path
     */
    protected const DEFAULT_IMAGE = 'default.jpg';

    /**
     * Get the week days in Portuguese.
     */
    public function getWeekDaysAttribute(): array
    {
        return ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
    }

    /**
     * Get the first image from the images array.
     */
    public function getFirstImageAttribute(): string
    {
        $images = $this->images;
        return $images[0] ?? self::DEFAULT_IMAGE;
    }

    /**
     * Get formatted working hours for display.
     */
    public function getFormattedWorkingHoursAttribute(): array
    {
        $workingHours = $this->working_hours;
        
        if (empty($workingHours)) {
            return [];
        }
        
        $groupedHours = [];
        $hoursMap = [];
        
        // Group days by same working hours
        foreach ($workingHours as $day => $times) {
            if (!isset($times['opening'])) {
                continue;
            }
            
            $timeStr = $this->formatTimeRange($times['opening'], $times['closing']);
            $hoursMap[$timeStr][] = strtolower($day);
        }
        
        // Format grouped hours for display
        foreach ($hoursMap as $time => $days) {
            $dayNames = array_map(
                fn($day) => self::DAYS_OF_WEEK[$day] ?? ucfirst($day), 
                $days
            );
            
            if (count($days) === 7) {
                $groupedHours[] = 'Todos os dias: ' . $time;
            } 
            elseif (count($days) > 1 && $this->isConsecutiveDays($days)) {
                $groupedHours[] = $dayNames[0] . '-' . end($dayNames) . ': ' . $time;
            } 
            else {
                $groupedHours[] = implode(', ', $dayNames) . ': ' . $time;
            }
        }
        
        return $groupedHours;
    }
    
    /**
     * Format time range from opening and closing times.
     */
    protected function formatTimeRange(string $opening, string $closing): string
    {
        return date('H:i', strtotime($opening)) . '-' . date('H:i', strtotime($closing));
    }
    
    /**
     * Check if days are consecutive in the week.
     */
    protected function isConsecutiveDays(array $days): bool
    {
        $indexes = [];
        
        foreach ($days as $day) {
            $index = array_search($day, self::DAY_ORDER);
            if ($index !== false) {
                $indexes[] = $index;
            }
        }
        
        sort($indexes);
        
        for ($i = 1; $i < count($indexes); $i++) {
            if ($indexes[$i] !== $indexes[$i-1] + 1) {
                return false;
            }
        }
        
        return count($indexes) > 0;
    }
    
    /**
     * Get the user that owns the local.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the view history for the local.
     */
    public function viewHistory(): HasMany
    {
        return $this->hasMany(ViewHistory::class, 'location_id');
    }

    /**
     * Scope a query to only include active locations.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get the full URL for the first image.
     */
    public function getFirstImageUrlAttribute(): string
    {
        return asset('img/' . $this->first_image);
    }
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'location_id');
    }

    /**
     * Check if the local is favorited by a specific user.
     */
    public function favoritedBy($user = null): bool
    {
        if (!$user) {
            return false;
        }
        
        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    /**
     * Scope a query to only include favorited locations by a user.
     */
    public function scopeFavoritedByUser($query, $userId)
    {
        return $query->whereHas('favorites', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    /**
     * Get all comments related to this location.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Accessor: Calculate the average rating of the location based on comments.
     */
    public function getAverageRatingAttribute()
    {
        return $this->comments()->avg('rating') ?? 0;
    }

    /**
     * Count the number of comments made today for this location.
     */
    public function commentsToday()
    {
        return $this->comments()->whereDate('created_at', Carbon::today())->count();
    }

}