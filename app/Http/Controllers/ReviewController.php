<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Destination;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['destination']);

        // Apply filters
        if ($request->filled('destination')) {
            $query->byDestination($request->destination);
        }

        if ($request->filled('rating')) {
            $query->byRating($request->rating);
        }

        // Apply sorting
        $query->orderBySort($request->get('sort', 'newest'));

        $reviews = $query->paginate(9);

        // Get destinations for filter
        $destinations = Destination::select('id', 'name')->get();

        // Get review stats
        $stats = [
            'total_reviews' => Review::count(),
            'average_rating' => round(Review::avg('rating'), 1),
            'positive_percentage' => round((Review::where('rating', '>=', 4)->count() / Review::count()) * 100),
            'monthly_reviews' => Review::whereMonth('review_date', now()->month)->count()
        ];

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.review-cards', compact('reviews'))->render(),
                'hasMore' => $reviews->hasMorePages()
            ]);
        }

        return view('reviews.index', compact('reviews', 'destinations', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'travel_type' => 'required|string'
        ]);

        Review::create([
            'destination_id' => $request->destination_id,
            'user_name' => $request->user_name,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
            'travel_type' => $request->travel_type,
            'review_date' => now(),
            'year' => now()->year,
            'helpful_count' => 0
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    public function like(Review $review)
    {
        $review->increment('helpful_count');
        
        return response()->json([
            'helpful_count' => $review->helpful_count
        ]);
    }
}
