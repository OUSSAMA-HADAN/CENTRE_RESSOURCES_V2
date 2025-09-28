<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Formation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category',
        'duration',
        'start_date',
        'end_date',
        'is_published',
        'thumbnail',
        'formateur',
        'platform'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-create slug if not provided
        static::creating(function ($formation) {
            if (empty($formation->slug)) {
                $formation->slug = Str::slug($formation->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the thumbnail URL.
     *
     * @return string|null
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        return asset('images/default-formation.jpg');
    }

    /**
     * Get the formateur's name.
     * 
     * @return string
     */
    public function getFormateurNameAttribute()
    {
        return $this->formateur ?? 'Non assigné';
    }

    /**
     * Get the platform name.
     * 
     * @return string
     */
    public function getPlatformNameAttribute()
    {
        return $this->platform ?? 'Non spécifié';
    }

    /**
     * Scope a query to only include published formations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include draft formations.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Check if formation has started.
     *
     * @return bool
     */
    public function hasStarted()
    {
        return $this->start_date && $this->start_date->isPast();
    }

    /**
     * Check if formation has ended.
     *
     * @return bool
     */
    public function hasEnded()
    {
        return $this->end_date && $this->end_date->isPast();
    }

    /**
     * Get the formation status.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        if (!$this->is_published) {
            return 'draft';
        }
        
        if ($this->hasEnded()) {
            return 'completed';
        }
        
        if ($this->hasStarted()) {
            return 'in_progress';
        }
        
        return 'upcoming';
    }
    
}