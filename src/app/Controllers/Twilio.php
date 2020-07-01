<?php

namespace TheCodealer\LaravelTwilio\Controllers;

use Illuminate\Http\Request;

use TheCodealer\LaravelTwilio\Models\CallEvent;
use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

use Twilio\TwiML\VoiceResponse;

class Twilio extends Controller {
    public function callGatherResponse(Request $request) {
        $response = new VoiceResponse();
        $response->dial(Config::getConfig('call_center_number'), [
            'answerOnBridge' => 'true',
            'record' => 'record-from-answer'
        ]);
        return $response;
    }

    public function callStatus(Request $request) {
        if ($request->CallSid) {
            $event = new CallEvent;
            $event->sid = $request->CallSid;
            $event->name = $request->CallStatus;
            $event->raw_response = json_encode($request->input());
            $event->save();
        }
    }
}
