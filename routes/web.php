<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PopularTimesController;
use App\Http\Controllers\EmailPreviewController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Mail\EventProbabilityAlert;
use App\Services\EmailService;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/popular-data', [PopularTimesController::class, 'getPopularityData'])->name('popular-data');

Route::get('/contact', function () {
return Inertia::render('Contact');})->name('contact');

// Route::get('/popular-activity', [PopularTimesController::class, 'getPopularTimes'])->name('popular-activity');

Route::get('/email/preview', [EmailPreviewController::class, 'previewEventProbabilityAlert']);

Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

// Testing Mailchimp API
// Route::get('/mailchimp', [EmailService::class, 'updateAndSendMailchimpCampaign'])->name('mailchimp');

require __DIR__.'/auth.php';