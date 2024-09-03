<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Resend\Laravel\Facades\Resend;
use Spatie\Newsletter\Facades\Newsletter;

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

        // Send email using Resend
        Resend::emails()->send([
            'from' => 'DC Pizza Meter <alerts@dcpizzameter.com>',
            'to' => ['contact@dcpizzameter.com'],
            'subject' => $subject,
            'html' => $html,
        ]);

        // Update and send Mailchimp campaign for medium and high alerts
        if (in_array($eventProbabilityTier, ['Medium', 'High'])) {
            $this->updateAndSendMailchimpCampaign(($eventProbabilityTier));
        }
    }

    public function updateAndSendMailchimpCampaign($level)
    {

        if ($level === 'High') {
            $campaignId = config('newsletter.mailchimp.high_campaign_id');
        } 
        elseif ($level === 'Extreme') {
            $campaignId = config('newsletter.mailchimp.extreme_campaign_id');
        }
        
        // exposes the Mailchimp API
        $api = Newsletter::getApi();

        $listCampaignsResponse = $api->get("/campaigns");


        // replicate the campaign
        $response = $api->post("/campaigns/{$campaignId}/actions/replicate");
        Log::info("Campaign replication response:", ['response' => $response]);

        // get the new campaign id
        $newCampaignId = $response['id'];

       
        
      

   $sendCampaignResponse = $api->post("/campaigns/{$newCampaignId}/actions/send");



   // Wait and retry deleting the campaign
   $maxAttempts = 5;
   $delaySeconds = 10;
   $attempt = 0;

   while ($attempt < $maxAttempts) {
       $attempt++;
       
       // Get status of campaign that was just sent
       $campaignStatusResponse = $api->get("/campaigns/{$newCampaignId}");

       if ($campaignStatusResponse['status'] === 'sent') {
           // Delete the campaign to not clutter the account
           $deleteCampaignResponse = $api->delete("/campaigns/{$newCampaignId}");
           Log::info("Campaign sent successfully and deleted!");
           return;
       } else {
           if ($attempt < $maxAttempts) {
               Log::info("Campaign not yet sent. Waiting to retry... (Attempt {$attempt}/{$maxAttempts})\n");
               sleep($delaySeconds);
           } else {
               Log::info("Max attempts reached. Campaign status: {$campaignStatusResponse['status']}");
           }
       }
   }

   
   // If we've reached this point, the campaign wasn't deleted
   Log::info("Failed to delete campaign after {$maxAttempts} attempts.");
//    dd($sendCampaignResponse, $maxAttempts, $delaySeconds, $attempt, $campaignStatusResponse);
   

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
