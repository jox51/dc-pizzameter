<?php

use App\Http\Controllers\PopularTimesController;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('meter:fetch-popularity')->hourly()->timezone('America/New_York')->between('17:00', '1:00');

// Schedule::command('meter:fetch-popularity')->hourly();


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


// Registering a custom console command
Artisan::command('meter:fetch-popularity', function (PopularTimesController $popularTimesController) {
    $popularTimesController->getPopularTimes();

    $this->info('Fetching popularity data');
})->describe('Fetch and process popularity data');
