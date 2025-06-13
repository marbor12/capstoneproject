<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\CsvDataService;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(DestinationSeeder::class);
        $csvDataService = new CsvDataService();
        $csvDataService->importAllData();
    }
}
