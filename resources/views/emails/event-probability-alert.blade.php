@php
/* @var string $eventProbabilityTier */
/* @var string $emoji */
/* @var float $pizzaBarRatio */
/* @var string $color */
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DC Pizza Meter Alert</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f4f4f4; padding: 20px; text-align: center; }
        .content { background-color: #ffffff; padding: 20px; }
        .footer { background-color: #f4f4f4; padding: 10px; text-align: center; font-size: 12px; }
        .ratio { font-size: 18px; margin-top: 10px; }
        .title-icons { display: flex; justify-content: center; align-items: center; gap: 10px; }
        .title-icons svg { width: 24px; height: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title-icons">
                <!-- Pizza icon -->
                <svg fill="#000000" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 224.512 224.512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <circle cx="89" cy="74.426" r="14.146"></circle> <path d="M112.256,126.77c-7.811,0-14.145,6.334-14.145,14.147c0,7.816,6.334,14.15,14.145,14.15c7.814,0,14.148-6.334,14.148-14.15 C126.404,133.104,120.07,126.77,112.256,126.77z"></path> <circle cx="133.563" cy="93.729" r="14.146"></circle> <path d="M195.287,16.574C168.741,5.576,140.776,0,112.169,0c-28.493,0-56.4,5.574-82.945,16.566 c-1.838,0.762-3.298,2.223-4.06,4.061c-0.761,1.838-0.761,3.904,0.001,5.742l11.992,28.932c0.001,0.004,0.005,0.008,0.007,0.012 l68.16,164.574c1.168,2.818,3.917,4.625,6.926,4.625c0.218,0,0.437-0.01,0.656-0.029c2.85-0.248,5.271-2.088,6.311-4.682 l68.143-164.49c0.002-0.004,0.004-0.006,0.006-0.01l11.98-28.928C200.93,22.545,199.113,18.158,195.287,16.574z M112.169,15 c24.133,0,47.778,4.264,70.397,12.688l-6.246,15.08c-20.618-7.598-42.157-11.445-64.138-11.445 c-21.896,0-43.382,3.848-63.982,11.443L41.946,27.68C64.554,19.262,88.141,15,112.169,15z M112.254,197.416L53.949,56.643 c18.766-6.846,38.317-10.32,58.232-10.32c20,0,39.605,3.477,58.389,10.324L112.254,197.416z"></path> </g> </g></svg>
                <h1>DC Pizza Meter Alert</h1>
                <!-- Beer icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17 11h1a3 3 0 0 1 0 6h-1"/>
                  <path d="M9 12v6"/>
                  <path d="M13 12v6"/>
                  <path d="M14 7.5c-1 0-1.44.5-3 .5s-2-.5-3-.5-1.72.5-2.5.5a2.5 2.5 0 0 1 0-5c.78 0 1.57.5 2.5.5S9.44 2 11 2s2 1.5 3 1.5 1.72-.5 2.5-.5a2.5 2.5 0 0 1 0 5c-.78 0-1.5-.5-2.5-.5Z"/>
                  <path d="M5 8v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V8"/>
                </svg>
            </div>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>We've detected a significant change in the DC Pizza Meter:</p>
            <p class="probability" style="color: {{ $color }};">Event Probability: {{ $eventProbabilityTier }} {{ $emoji }}</p>
            <p class="ratio">Pizza-to-Bar Ratio: {{ $pizzaBarRatio }}</p>
            <p>This could indicate increased activity in the DC area. Please stay alert and consider adjusting your plans accordingly.</p>
            <p>For more details, visit the <a href="https://dcpizzameter.com" style="color: #007bff; text-decoration: underline;">DC Pizza Meter dashboard</a>.</p>
        </div>
        <div class="footer">
            <p>This is an automated alert from the DC Pizza Meter system. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
