<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // List destinasi (dengan filter sederhana)
    public function index(Request $request)
    {
        $query = Destination::query();

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

        $destinations = $query->with('reviews')->paginate(10);

        return response()->json($destinations);
    }

    // Detail destinasi
    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->with(['reviews' => function ($q) {
                $q->orderBy('review_date', 'desc')->take(10);
            }])
            ->firstOrFail();

        return response()->json($destination);
    }
}