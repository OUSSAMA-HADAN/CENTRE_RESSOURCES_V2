<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recherche extends Model
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
        'summary',
        'content',
        'category',
        'published_at',
        'is_published',
        'cover_image',
        'pdf_file',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        // Auto-create slug if not provided
        static::creating(function ($recherche) {
            if (empty($recherche->slug)) {
                $recherche->slug = Str::slug($recherche->title);
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
     * Get the cover image URL.
     *
     * @return string
     */
    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : null;
    }

    /**
     * Get the PDF URL.
     *
     * @return string|null
     */
    public function getPdfUrlAttribute()
    {
        return $this->pdf_file
            ? asset('storage/' . $this->pdf_file)
            : null;
    }

    /**
     * Get the formatted publication date.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d/m/Y') : null;
    }

    /**
     * Scope a query to only include published items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include draft items.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }
}
