<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locations';

    protected $casts = [
        'images' => 'array',
        'features' => 'array',
        'working_hours' => 'array'
    ];
    
    protected $appends = [
        'first_image',
        'formatted_working_hours',
        'week_days'
    ];

    public function getWeekDaysAttribute(): array
    {
        return ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];
    }

    public function getFirstImageAttribute(): string
    {
        $images = $this->images;
        
        if (is_string($images)) {
            $images = json_decode($images, true) ?? [];
        }
        
        return $images[0] ?? 'default.jpg';
    }

    public function getFormattedWorkingHoursAttribute(): array
    {
        $workingHours = $this->working_hours;
        
        if (is_string($workingHours)) {
            $workingHours = json_decode($workingHours, true) ?? [];
        }
        
        if (empty($workingHours)) {
            return [];
        }
        
        $groupedHours = [];
        $hoursMap = [];
        
        foreach ($workingHours as $day => $times) {
            if (!isset($times['opening'])) continue;
            
            $timeStr = $this->formatTimeRange($times['opening'], $times['closing']);
            $hoursMap[$timeStr][] = strtolower($day);
        }
        
        foreach ($hoursMap as $time => $days) {
            $dayAbbrs = [
                'segunda' => 'Seg',
                'terça' => 'Ter',
                'quarta' => 'Qua',
                'quinta' => 'Qui',
                'sexta' => 'Sex',
                'sábado' => 'Sáb',
                'domingo' => 'Dom'
            ];
            
            $dayNames = array_map(fn($day) => $dayAbbrs[$day] ?? ucfirst($day), $days);
            
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
    
    protected function formatTimeRange(string $opening, string $closing): string
    {
        return date('H:i', strtotime($opening)) . '-' . date('H:i', strtotime($closing));
    }
    
    protected function isConsecutiveDays(array $days): bool
    {
        $dayOrder = ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo'];
        $indexes = [];
        
        foreach ($days as $day) {
            if ($index = array_search($day, $dayOrder)) {
                $indexes[] = $index;
            }
        }
        
        sort($indexes);
        
        for ($i = 1; $i < count($indexes); $i++) {
            if ($indexes[$i] != $indexes[$i-1] + 1) {
                return false;
            }
        }
        
        return true;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
