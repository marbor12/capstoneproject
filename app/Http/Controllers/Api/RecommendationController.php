<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $preferences = $request->all();
        $query = Destination::with('reviews');

        if (!empty($preferences['travel_type'])) {
            $query->whereJsonContains('travel_type', $preferences['travel_type']);
        }
        if (!empty($preferences['visit_month'])) {
            $query->whereJsonContains('best_months', $preferences['visit_month']);
        }
        if (!empty($preferences['categories'])) {
            $query->whereIn('category', $preferences['categories']);
        }
        if (!empty($preferences['budget'])) {
            $query->where('price_range', $preferences['budget']);
        }
        if (!empty($preferences['duration'])) {
            $query->where('duration', $preferences['duration']);
        }
        if (!empty($preferences['activity_level'])) {
            $query->where('activity_level', $preferences['activity_level']);
        }

        $recommendations = $query->get();

        if ($recommendations->isEmpty()) {
            $recommendations = Destination::where('is_recommended', true)
                ->with('reviews')
                ->orderByDesc(function($query) {
                    $query->selectRaw('AVG(rating)')
                        ->from('reviews')
                        ->whereColumn('reviews.destination_id', 'destinations.id');
                })
                ->take(6)
                ->get();
        } else {
            $recommendations = $recommendations->sortByDesc(function($destination) {
                return $destination->average_rating;
            })->take(6)->values();
        }

        return response()->json($recommendations);
    }
}