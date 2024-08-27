<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailPreviewController extends Controller
{
    public function previewEventProbabilityAlert()
    {
        $data = [
            'eventProbabilityTier' => 'Medium',
            'emoji' => '⚠️',
            'pizzaBarRatio' => 1.5,
            'color' => '#ff851b',
        ];

        return view('emails.event-probability-alert', $data);
    }
}
