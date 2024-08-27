<?php

namespace App\Services;

use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use App\Models\Location;
use App\Models\PopularityData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PopularTimesService
{
    public function fetchPopularTimes()
    {
        $iterationId = $this->getNewIterationId();

        $pizzaLocations = Location::where('type', 'pizza')->pluck('place_id');
        $barLocations = Location::where('type', 'bar')->pluck('place_id');

        Log::info('1. Entering getPopularTimes method for iteration: ' . $iterationId);

        $allResults = [];
        $errors = [];

        foreach (['pizza' => $pizzaLocations, 'bar' => $barLocations] as $type => $locations) {
            foreach ($locations as $placeId) {
                try {
                    Log::info('2. Processing PlaceId: ' . $placeId . ' of type: ' . $type);

                    // set max execution time to 50 minutes
                    set_time_limit(3000);

                    $process = new Process([
                      '/home/forge/.local/share/pypoetry/venv/bin/poetry',
                      "run",
                      "python",
                      "main.py",
                      $placeId
                    ]);

                    // $process = new Process([
                    //     'poetry',
                    //     'run',
                    //     'python',
                    //     'main.py',
                    //     $placeId
                    // ]);
                    
                    $process->setWorkingDirectory(base_path('scripts/LivePopularTimes'));
                    $process->run();

                    if (!$process->isSuccessful()) {
                        Log::error('Process failed for PlaceId ' . $placeId . ': ' . $process->getErrorOutput());
                        $errors[] = 'Failed to process PlaceId: ' . $placeId;
                        continue;
                    }

                    $output = $process->getOutput();
                    $result = json_decode($output, true);
                    
                    if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                        Log::error('JSON decode error for PlaceId ' . $placeId . ': ' . json_last_error_msg());
                        $errors[] = 'Failed to decode JSON for PlaceId: ' . $placeId;
                        continue;
                    }

                    $result['type'] = $type;
                    $result['iteration_id'] = $iterationId;
                    $this->savePopularityData($result);
                    $allResults[] = $result;

                } catch (\Exception $e) {
                    Log::error('Error processing PlaceId ' . $placeId . ': ' . $e->getMessage());
                    $errors[] = 'Error processing PlaceId: ' . $placeId;
                }
            }
        }

        // return [
        //     'popularTimes' => $allResults,
        //     'errors' => $errors,
        //     'iterationId' => $iterationId
        // ];
    }

    private function savePopularityData($data)
    {
        if (isset($data['place_id']) && isset($data['name']) && isset($data['type']) && isset($data['iteration_id'])) {
            PopularityData::create([
                'place_id' => $data['place_id'],
                'name' => $data['name'],
                'type' => $data['type'],
                'current_popularity' => $data['current_popularity'] ?? null,
                'iteration_id' => $data['iteration_id'],
                'created_at' => Carbon::now(), // Explicitly set the creation time
            ]);
            Log::info('Popularity data saved for: ' . $data['name'] . ' (Type: ' . $data['type'] . ', Iteration: ' . $data['iteration_id'] . ')');
        } else {
            Log::warning('Required data missing for saving popularity data');
        }
    }

    private function getNewIterationId()
    {
        $currentYear = Carbon::now()->year;
        $firstDayOfYear = Carbon::create($currentYear, 1, 1)->startOfDay();

        $latestRecord = DB::table('popularity_data')
            ->where('created_at', '>=', $firstDayOfYear)
            ->orderBy('iteration_id', 'desc')
            ->first();

        if ($latestRecord) {
            return $latestRecord->iteration_id + 1;
        }

        return 1; // Start with 1 for the first iteration of the year
    }
}