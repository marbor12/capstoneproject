<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'location',
        'price',
        'price_range',
        'image',
        'facilities',
        'open_hours',
        'best_time',
        'travel_type',
        'best_months',
        'duration',
        'activity_level',
        'is_recommended',
        'csv_source'
    ];

    protected $casts = [
        'facilities' => 'array',
        'travel_type' => 'array',
        'best_months' => 'array',
        'is_recommended' => 'boolean'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function scopeByRating($query, $minRating)
    {
        if ($minRating) {
            return $query->whereHas('reviews', function($q) use ($minRating) {
                $q->havingRaw('AVG(rating) >= ?', [$minRating]);
            });
        }
        return $query;
    }

    public function scopeByPriceRange($query, $priceRange)
    {
        if ($priceRange) {
            return $query->where('price_range', $priceRange);
        }
        return $query;
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }
        return $query;
    }
}
