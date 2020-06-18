<?php

namespace TheCodealer\LaravelTwilio\SendingProfiles;

use Twilio\TwiML\VoiceResponse;

use TheCodealer\LaravelTwilio\Traits\SendingProfileTrait;
use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class CallCenterSendingProfile {
    use SendingProfileTrait;

    protected $profileType = 'call';
    protected $twiml = null;
    protected $recordCall = true;
    protected $trackCallStatus = true;

    protected $data = [];

    public function getTwiml() {
        $response = new VoiceResponse();

        $action = Config::getConfig('call_gather_response_url') ? Config::getConfig('call_gather_response_url') : route('thecodealerlaraveltwilio.callbacks.twilio.call-gather-response');
        $gather = $response->gather(['action' => $action, 'method' => 'GET', 'numDigits' => 1]);
        $gather->say('Hello, welcome');
        $gather->say('Please press one, followed by the hash sign, to connect to our call center');
        return $response;
    }
}
