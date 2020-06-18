<?php

namespace TheCodealer\LaravelTwilio\Services;

use Twilio\Rest\Client;

use TheCodealer\LaravelTwilio\Models\CallRequest;
use TheCodealer\LaravelTwilio\Models\Call;
use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

trait TwilioService {
    public static function client() {
        return new Client(config('twilio.sid'), config('twilio.token'));
    }

    public static function call($recipient, $sender_id = null, $profile = null) {
        $to = $recipient;
        $from = $sender_id;
        if ($recipient instanceof CallRequest) {
            $call_request = $recipient;
            $to = $call_request->number;
            $from = $call_request->caller_id;
        }

        $client = self::client();
        $sending_profile = self::getCallingSendingProfile($profile);
        $options = $sending_profile->getOptions();

        try {
            $create = $client->calls->create($to, $from, $options);
            if (isset($create->sid)) {
                $call = new Call;
                $call->sid = $create->sid;
                if (isset($call_request)) {
                    $call->call_request_id = $call_request->id;
                }
                $call->save();

                $call_request->status = 'requested';
                $call_request->save();
            }
        }
        catch(Exception $e) {
            print_r($e->getMessage());
        }
    }

    public static function getCallingSendingProfile($name = null) {
        if (!$name) {
            $name = Config::getConfig('default_calling_profile');
        }
        $class = Config::getConfig('calling_profiles.' . $name);

        if (class_exists($class)) {
            return $profile = new $class;
        }
    }
}
