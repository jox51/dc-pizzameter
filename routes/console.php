<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Add the new command for fetching pizza data
Artisan::command('pizza:fetch-data', function () {
    $output = shell_exec('python3 ' . base_path('python/main.py'));
    $this->info('Pizza data fetched successfully.');
})->purpose('Fetch pizza data using Python script');