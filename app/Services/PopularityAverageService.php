<?php

namespace App\Services;

use App\Models\PopularityData;
use App\Models\PopularityAverage;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PopularityAverageService
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

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
        $eventProbabilityTier = $this->calculateEventProbabilityTier($ratio);

        $popularityAverage = PopularityAverage::create([
            'iteration_id' => $latestIterationId,
            'pizza_average_popularity' => round($pizzaAverage, 2),
            'bar_average_popularity' => round($barAverage, 2),
            'pizza_bar_ratio' => round($ratio, 2),
            'pizza_count' => $pizzaCount,
            'bar_count' => $barCount,
            'event_probability_tier' => $eventProbabilityTier,
        ]);

        $this->sendAlertIfNeeded($popularityAverage);

        return $latestIterationId;
    }

    private function sendAlertIfNeeded(PopularityAverage $popularityAverage)
    {
        if (in_array($popularityAverage->event_probability_tier, ['High', 'Extreme'])) {
            $this->emailService->sendEventProbabilityAlert(
                $popularityAverage->event_probability_tier,
                $popularityAverage->pizza_bar_ratio
            );
        }
    }

    private function calculateEventProbabilityTier($ratio)
    {
        if ($ratio >= 3.0) {
            return 'Extreme';
        } elseif ($ratio >= 2.0) {
            return 'High';
        } elseif ($ratio >= 1.0) {
            return 'Medium';
        } else {
            return 'Low';
        }
    }

    public function getLatestAverages()
    {
        // Get the latest iteration ID
        $latestIterationId = PopularityAverage::max('iteration_id');

        // If there are multiple records with the latest iteration ID, get the last one
        $query = PopularityAverage::where('iteration_id', $latestIterationId);
        if ($query->count() > 1) {
            $averages = $query->latest('id')->first();
        } else {
            $averages = $query->first();
        }
      
        
        if ($averages) {
            $averages->pizza_average_popularity = round($averages->pizza_average_popularity, 2);
            $averages->bar_average_popularity = round($averages->bar_average_popularity, 2);
            $averages->pizza_bar_ratio = round($averages->pizza_bar_ratio, 2);
            
            // Convert UTC to EDT and format the updated_at timestamp
            $averages->last_updated = $averages->updated_at
                ->setTimezone('America/New_York')
                ->format('Y-m-d H:i:s T');
        }

        return $averages;
    }
}