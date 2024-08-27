<?php

namespace App\Services;

use App\Models\PopularityData;
use App\Models\PopularityAverage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PopularityAverageService
{
    public function calculateAndSaveAverages()
    {
        $latestIterationId = PopularityData::max('iteration_id');

        $pizzaData = PopularityData::where('iteration_id', $latestIterationId)
            ->where('type', 'pizza')
            ->whereNotNull('current_popularity');

        $barData = PopularityData::where('iteration_id', $latestIterationId)
            ->where('type', 'bar')
            ->whereNotNull('current_popularity');

        $pizzaAverage = $pizzaData->avg('current_popularity') ?? 0;
        $barAverage = $barData->avg('current_popularity') ?? 0;

        $pizzaCount = $pizzaData->count();
        $barCount = $barData->count();

        $ratio = $barAverage != 0 ? $pizzaAverage / $barAverage : 0;

        PopularityAverage::create([
            'iteration_id' => $latestIterationId,
            'pizza_average_popularity' => round($pizzaAverage, 2),
            'bar_average_popularity' => round($barAverage, 2),
            'pizza_bar_ratio' => round($ratio, 2),
            'pizza_count' => $pizzaCount,
            'bar_count' => $barCount,
        ]);

        return $latestIterationId;
    }

    public function getLatestAverages()
    {
        $averages = PopularityAverage::latest('iteration_id')->first();
        
        if ($averages) {
            $averages->pizza_average_popularity = round($averages->pizza_average_popularity, 2);
            $averages->bar_average_popularity = round($averages->bar_average_popularity, 2);
            $averages->pizza_bar_ratio = round($averages->pizza_bar_ratio, 2);
            
            // Convert UTC to Eastern Time and format the updated_at timestamp
            $averages->last_updated = $averages->updated_at
                ->setTimezone('America/New_York')
                ->format('F j, Y g:i A T'); // March 15, 2023 7:38 PM EDT
        }

        return $averages;
    }
}