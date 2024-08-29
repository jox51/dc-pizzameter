<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Newsletter\Facades\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        try {

            if (Newsletter::isSubscribed($email)) {
                return Inertia::render('Welcome', [
                    'message' => "You're already subscribed to the newsletter!",
                    'isSubscribed' => true,
                ]);
            } else { 


                Newsletter::subscribe($email);
    
                return Inertia::render('Welcome', [
                    'message' => "Thank you for subscribing!",
                    'newSubscriber' => true,
                ]);
            }



            
            
        } catch (\Exception $e) {
            return to_route('popular-data', ['errors' => 'An error occurred while subscribing. Please try again later.']);
        }
    }
}
