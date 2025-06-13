<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::with(['reviews']);

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('rating')) {
            $query->byRating($request->rating);
        }

        if ($request->filled('budget')) {
            $query->byPriceRange($request->budget);
        }

        // Apply sorting
        switch ($request->get('sort', 'popular')) {
            case 'rating':
                $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price':
                $query->orderByRaw("CASE 
                    WHEN price = 'Gratis' THEN 0 
                    ELSE CAST(REGEXP_REPLACE(price, '[^0-9]', '') AS UNSIGNED) 
                END ASC");
                break;
            default: // popular
                $query->withCount('reviews')->orderBy('reviews_count', 'desc');
        }

        $destinations = $query->paginate(9);

        // Get categories for filter
        $categories = [
            'pantai' => 'Pantai',
            'gunung' => 'Gunung',
            'budaya' => 'Budaya',
            'kuliner' => 'Kuliner',
            'adventure' => 'Adventure',
            'spa' => 'Spa',
            'family' => 'Family'
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.destination-cards', compact('destinations'))->render(),
                'hasMore' => $destinations->hasMorePages()
            ]);
        }

        return view('destinations.index', compact('destinations', 'categories'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->with([
                'reviews' => function ($query) {
                    $query->orderBy('review_date', 'desc')->take(10);
                }
            ])
            ->firstOrFail();

        // Get related destinations (same category)
        $relatedDestinations = Destination::where('category', $destination->category)
            ->where('id', '!=', $destination->id)
            ->with(['reviews'])
            ->take(3)
            ->get();

        return view('destinations.show', compact('destination', 'relatedDestinations'));
    }
}
