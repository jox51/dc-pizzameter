<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Resend\Laravel\Facades\Resend;

class EmailService
{
    public function sendEventProbabilityAlert($eventProbabilityTier, $pizzaBarRatio)
    {
        $subject = "DC Pizza Meter Alert: {$eventProbabilityTier} Event Probability";
        
        $data = [
            'eventProbabilityTier' => $eventProbabilityTier,
            'pizzaBarRatio' => $pizzaBarRatio,
            'color' => $this->getProbabilityColor($eventProbabilityTier),
            'emoji' => $this->getProbabilityEmoji($eventProbabilityTier),
        ];

        $html = view('emails.event-probability-alert', $data)->render();

        Resend::emails()->send([
            'from' => 'DC Pizza Meter <alerts@dcpizzameter.com>',
            'to' => ['contact@dcpizzameter.com'],
            'subject' => $subject,
            'html' => $html,
        ]);
    }

    private function getProbabilityColor($tier)
    {
        switch ($tier) {
            case 'High':
                return '#ff4136';
            case 'Medium':
                return '#ff851b';
            default:
                return '#2ecc40';
        }
    }

    private function getProbabilityEmoji($tier)
    {
        switch ($tier) {
            case 'High':
                return '🚨';
            case 'Medium':
                return '⚠️';
            default:
                return '✅';
        }
    }
}
