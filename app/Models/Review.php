<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'user_name',
        'rating',
        'review_text',
        'review_date',
        'travel_type',
        'year',
        'helpful_count'
    ];

    protected $casts = [
        'review_date' => 'date',
        'rating' => 'integer',
        'year' => 'integer',
        'helpful_count' => 'integer'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function scopeByDestination($query, $destinationId)
    {
        if ($destinationId) {
            return $query->where('destination_id', $destinationId);
        }
        return $query;
    }

    public function scopeByRating($query, $rating)
    {
        if ($rating) {
            return $query->where('rating', $rating);
        }
        return $query;
    }

    public function scopeOrderBySort($query, $sort)
    {
        switch ($sort) {
            case 'oldest':
                return $query->orderBy('review_date', 'asc');
            case 'helpful':
                return $query->orderBy('helpful_count', 'desc');
            case 'rating':
                return $query->orderBy('rating', 'desc');
            default: // newest
                return $query->orderBy('review_date', 'desc');
        }
    }
}
