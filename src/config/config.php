<?php

return [
    'table_prefix' => env('THE_CODEALER_LARAVEL_TWILIO_TABLE_PREFIX', 'tcdlt_'),
    'zapier_token' => env('THE_CODEALER_LARAVEL_TWILIO_ZAPIER_TOKEN', '8iGKip16cw5CyJ8JJdW5F7ksrMeW46tP9X8W4bghD84HBTgAL7ai47Hrx42V52aF'),
    'default_calling_profile' => env('THE_CODEALER_LARAVEL_TWILIO_DEFAULT_CALLING_PROFILE', 'CallCenter'),
    'calling_profiles' => [
        'CallCenter' => TheCodealer\LaravelTwilio\SendingProfiles\CallCenterSendingProfile::class
    ],
    'call_center_number' => env('THE_CODEALER_LARAVEL_TWILIO_CALL_CENTER_NUMBER'),
    'call_status_callback_url' => env('THE_CODEALER_LARAVEL_TWILIO_CALL_STATUS_CALLBACK_URL'),
    'call_gather_response_url' => env('THE_CODEALER_LARAVEL_TWILIO_CALL_GATHER_RESPONSE_URL'),
    'call_twiml_url' => env('THE_CODEALER_LARAVEL_TWILIO_CALL_TWIML_URL'),
];