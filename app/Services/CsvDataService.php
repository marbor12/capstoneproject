<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Destination;
use App\Models\Review;

class CsvDataService
{
    public function importAllData()
    {
        $csvDir = storage_path('app/csv/');
        $files = glob($csvDir . '*_reviews.csv');

        foreach ($files as $csvPath) {
            // Ambil nama file tanpa ekstensi dan tanpa _reviews
            $slug = basename($csvPath, '.csv');
            $slug = str_replace('_reviews', '', $slug);
            $slug = str_replace('_', '-', $slug);

            $this->importDestinationAndReviews($slug, $csvPath);
        }
    }

    private function importDestinationAndReviews($slug, $csvPath)
    {
        // Ambil data destinasi dari database berdasarkan slug
        $destination = Destination::where('slug', $slug)->first();

        // Jika belum ada, skip (atau bisa juga buat dummy destinasi)
        if (!$destination) {
            Log::warning("Destination not found for slug: {$slug}");
            return;
        }

        $this->importReviews($csvPath, $destination);
    }

    private function importReviews($csvPath, $destination)
    {
        try {
            if (!file_exists($csvPath)) {
                throw new \Exception("File not found: {$csvPath}");
            }

            $lines = file($csvPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $headers = str_getcsv(array_shift($lines));

            foreach ($lines as $line) {
                if (empty(trim($line))) continue;

                $data = str_getcsv($line);
                if (count($data) !== count($headers)) continue;

                $reviewData = array_combine($headers, $data);

                $this->createReview($reviewData, $destination);
            }
        } catch (\Exception $e) {
            Log::error("Failed to import reviews: " . $e->getMessage());
            throw $e;
        }
    }

    private function createReview($reviewData, $destination)
    {
        $dateInfo = $this->parseDateInfo($reviewData['date'] ?? '');

        Review::create([
            'destination_id' => $destination->id,
            'user_name' => $reviewData['user'] ?? 'Anonymous',
            'rating' => (int) ($reviewData['rating'] ?? 5),
            'review_text' => $reviewData['review'] ?? '',
            'review_date' => $dateInfo['date'],
            'travel_type' => $dateInfo['travel_type'],
            'year' => (int) ($reviewData['year'] ?? date('Y')),
            'helpful_count' => rand(5, 50)
        ]);
    }

    private function parseDateInfo($dateString)
    {
        $parts = explode(' • ', $dateString);
        $datePart = $parts[0] ?? '';
        $travelType = strtolower($parts[1] ?? 'solo');

        try {
            $date = \Carbon\Carbon::createFromFormat('M Y', $datePart)->startOfMonth();
        } catch (\Exception $e) {
            $date = now();
        }

        return [
            'date' => $date,
            'travel_type' => $travelType
        ];
    }

    public function getDestinationStats()
    {
        return [
            'total_destinations' => Destination::count(),
            'total_reviews' => Review::count(),
            'average_rating' => round(Review::avg('rating'), 1),
            'categories' => Destination::select('category')
                ->groupBy('category')
                ->pluck('category')
                ->toArray()
        ];
    }
}