<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        // Get user preferences from session or request
        $preferences = session('user_preferences', []);
        
        $query = Destination::with(['reviews']);

        // Apply AI-like filtering based on preferences
        if (!empty($preferences['travel_type'])) {
            $query->whereJsonContains('travel_type', $preferences['travel_type']);
        }

        if (!empty($preferences['visit_month'])) {
            $query->whereJsonContains('best_months', (int)$preferences['visit_month']);
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

        // If no preferences or no matches, show recommended destinations
        $recommendations = $query->get();
        
        if ($recommendations->isEmpty()) {
            $recommendations = Destination::where('is_recommended', true)
                ->with(['reviews'])
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
            })->take(6);
        }

        return view('recommendations.index', compact('recommendations', 'preferences'));
    }

    public function updatePreferences(Request $request)
    {
        $preferences = $request->validate([
            'travel_type' => 'nullable|string',
            'visit_month' => 'nullable|integer|min:1|max:12',
            'categories' => 'nullable|array',
            'budget' => 'nullable|string',
            'duration' => 'nullable|string',
            'activity_level' => 'nullable|string',
            'facilities' => 'nullable|array'
        ]);

        // Store preferences in session
        session(['user_preferences' => array_filter($preferences)]);

        return redirect()->route('recommendations.index')
            ->with('success', 'Preferensi berhasil diperbarui!');
    }

    public function resetPreferences()
    {
        session()->forget('user_preferences');
        
        return redirect()->route('recommendations.index')
            ->with('success', 'Preferensi telah direset!');
    }
}
