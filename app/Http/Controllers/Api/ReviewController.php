<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // List review (dengan filter)
    public function index(Request $request)
    {
        $query = Review::with('destination');

        if ($request->filled('destination')) {
            $query->byDestination($request->destination);
        }
        if ($request->filled('rating')) {
            $query->byRating($request->rating);
        }
        $query->orderBySort($request->get('sort', 'newest'));

        return response()->json($query->paginate(10));
    }

    // Detail review
    public function show($id)
    {
        $review = Review::with('destination')->findOrFail($id);
        return response()->json($review);
    }

    // Tambah review
    public function store(Request $request)
    {
        $data = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'travel_type' => 'required|string'
        ]);
        $data['review_date'] = now();
        $data['year'] = now()->year;
        $data['helpful_count'] = 0;

        $review = Review::create($data);
        return response()->json($review, 201);
    }

    // Like review
    public function like(Review $review)
    {
        $review->increment('helpful_count');
        return response()->json(['helpful_count' => $review->helpful_count]);
    }
}