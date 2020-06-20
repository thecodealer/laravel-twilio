<?php

namespace TheCodealer\LaravelTwilio\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use TheCodealer\LaravelTwilio\Models\CallRequest;
use TheCodealer\LaravelTwilio\Models\CallEvent;
use TheCodealer\LaravelTwilio\Models\Call;
use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;
use TheCodealer\LaravelTwilio\Services\TwilioService;

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

            if ($event->name == 'completed') {
                //update call duration
                $call = Call::where('sid', $event->sid)->first();
                if ($call) {
                    $call->duration = $request->CallDuration;
                    try {
                        $call->save();
                    }
                    catch(\Exception $e) {
                    }
                }

                //retry if not answered
                if (Config::getConfig('call_retry_hours')) {
                    //check if call was ever in progress (to indicate it was answered), otherwise mark for retry
                    $in_progress = CallEvent::where('sid', $event->sid)->where('name', 'in-progress')->first();
                    if (!$in_progress) {
                        $call_request = CallRequest::where('id', $call->call_request_id)->where('status', 'requested')->first();
                        if ($call_request) {
                            $retry_time = Carbon::now()->add(Config::getConfig('call_retry_hours'), 'hour');
                            $call_request->status = 'retry';
                            $call_request->retry_at = $retry_time;
                            try {
                                $call_request->save();
                            }
                            catch(\Exception $e) {}
                        }
                    }
                }
            }
        }
    }
}
