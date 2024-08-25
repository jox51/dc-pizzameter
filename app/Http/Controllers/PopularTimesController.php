<?php

namespace App\Http\Controllers;

use App\Models\PopularityData;
use App\Services\PopularTimesService;
use App\Services\PopularityAverageService;
use Inertia\Inertia;

class PopularTimesController extends Controller
{
    protected $popularTimesService;
    protected $popularityAverageService;

    public function __construct(PopularTimesService $popularTimesService, PopularityAverageService $popularityAverageService)
    {
        $this->popularTimesService = $popularTimesService;
        $this->popularityAverageService = $popularityAverageService;
    }

    public function getPopularTimes()
    {
        // Fetch popular times and save to database
        // $this->popularTimesService->fetchPopularTimes();

        // Calculate and save averages
        // $this->popularityAverageService->calculateAndSaveAverages();

        // Get the latest averages
        $averages = $this->popularityAverageService->getLatestAverages()->toArray();
        // dd($averages);
       
        // $latestIterationId = PopularityData::max('iteration_id');
        // $popularTimes = PopularityData::where('iteration_id', $latestIterationId)->get()->toArray();

        return Inertia::render('Welcome', [
            'averages' => $averages,
        ]);
    }
}