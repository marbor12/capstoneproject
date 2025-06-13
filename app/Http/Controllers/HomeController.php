<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;
use App\Services\CsvDataService;

class HomeController extends Controller
{
    protected $csvDataService;

    public function __construct(CsvDataService $csvDataService)
    {
        $this->csvDataService = $csvDataService;
    }

    public function index()
    {
        // Get featured destinations (recommended ones)
        $featuredDestinations = Destination::where('is_recommended', true)
            ->with(['reviews'])
            ->take(3)
            ->get();

        // Get stats
        $stats = $this->csvDataService->getDestinationStats();

        return view('home', compact('featuredDestinations', 'stats'));
    }

    public function search(Request $request)
    {
        $query = Destination::with(['reviews']);

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('rating')) {
            $query->byRating($request->rating);
        }

        $destinations = $query->paginate(6);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.destination-cards', compact('destinations'))->render(),
                'hasMore' => $destinations->hasMorePages()
            ]);
        }

        return redirect()->route('destinations.index', $request->all());
    }
}
