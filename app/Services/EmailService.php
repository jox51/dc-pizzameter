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
            $this->updateAndSendMailchimpCampaign($eventProbabilityTier, $pizzaBarRatio);
        }
    }

    public function updateAndSendMailchimpCampaign($eventProbabilityTier, $pizzaBarRatio)
    {

        // main campaign id to replicate
        $campaignId = config('newsletter.mailchimp.campaign_id');

        
        // exposes the Mailchimp API
        $api = Newsletter::getApi();

        // replicate the campaign
        $response = $api->post("/campaigns/{$campaignId}/actions/replicate");
        Log::info("Campaign replication response:", ['response' => $response]);

        // get the new campaign id
        $newCampaignId = $response['id'];

        // update the campaign settings
      $newCampaignResponse =  $api->patch("/campaigns/{$newCampaignId}", [
            'settings' => [
                'subject_line' => "DC Pizza Meter Alert: '{$eventProbabilityTier}' Event Probability",
                'preview_text' => "DC Pizza Meter Alert: {$eventProbabilityTier} Event Probability",
            ],
        ]);
        Log::info("Campaign settings update response:", ['response' => $newCampaignResponse]);

     // create html content
      $html = $this->getFormattedHtml($eventProbabilityTier, $pizzaBarRatio);
      
      // Encode the HTML content
      $encodedHtml = base64_encode($html);

      // Log the HTML content
      Log::info("Generated HTML content:", ['html' => $html]);

      // set campaign content
      $campaignContentResponse = $api->put("/campaigns/{$newCampaignId}/content", [
            'html' => $encodedHtml,
            'plain_text' => strip_tags($html), // Add a plain text version
        ]);

      // Log the response from setting campaign content
      Log::info("Campaign content set response:", ['response' => $campaignContentResponse]);

        
      

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

    private function getFormattedHtml($eventProbabilityTier, $pizzaBarRatio)
    {
        $color = $this->getProbabilityColor($eventProbabilityTier);
        $emoji = $this->getProbabilityEmoji($eventProbabilityTier);

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DC Pizza Meter Alert</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: {$color}; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{$emoji} DC Pizza Meter Alert {$emoji}</h1>
            <h2>{$eventProbabilityTier} Event Probability</h2>
        </div>
        <div class="content">
            <p>Hello DC Pizza Enthusiasts,</p>
            <p>We have detected a <strong>{$eventProbabilityTier}</strong> probability of a significant event in DC.</p>
            <p>Current Pizza Bar Ratio: <strong>{$pizzaBarRatio}</strong></p>
            <p>Stay alert and keep an eye on your local pizza establishments!</p>
            <p>For more information, visit <a href="https://dcpizzameter.com">DC Pizza Meter</a>.</p>
        </div>
        <div class="footer">
            <p>© 2023 DC Pizza Meter. All rights reserved.</p>
            <p>You're receiving this email because you subscribed to DC Pizza Meter alerts.</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
}
