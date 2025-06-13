<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CsvDataService;

class ImportCsvData extends Command
{
    protected $signature = 'csv:import';
    protected $description = 'Import data from CSV files';

    public function handle()
    {
        $this->info('Starting CSV data import...');
        
        $csvDataService = new CsvDataService();
        
        try {
            $csvDataService->importAllData();
            $this->info('CSV data imported successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to import CSV data: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
