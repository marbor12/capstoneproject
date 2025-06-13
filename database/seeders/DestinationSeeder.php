<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $csvDir = storage_path('app/csv/');
        $files = glob($csvDir . '*_reviews.csv');

        foreach ($files as $csvPath) {
            $slug = basename($csvPath, '.csv');
            $slug = str_replace('_reviews', '', $slug);
            $slug = str_replace('_', '-', $slug);

            // Cek apakah destinasi sudah ada
            if (Destination::where('slug', $slug)->exists()) {
                continue;
            }

            // Buat dummy destinasi
            Destination::create([
                'name' => Str::title(str_replace('-', ' ', $slug)),
                'slug' => $slug,
                'category' => 'budaya', // default / bisa random
                'description' => 'Deskripsi untuk ' . Str::title(str_replace('-', ' ', $slug)),
                'location' => 'Belum diketahui',
                'price' => 'Gratis',
                'price_range' => '0',
                'image' => 'default.jpg',
                'facilities' => ['toilet', 'parkir'],
                'open_hours' => '08:00 - 17:00',
                'best_time' => 'Pagi Hari',
                'travel_type' => ['solo', 'keluarga'],
                'best_months' => ['Juni', 'Juli'],
                'duration' => '1-2 jam',
                'activity_level' => 'Sedang',
                'is_recommended' => false,
                'csv_source' => basename($csvPath),
            ]);
        }
    }
}
