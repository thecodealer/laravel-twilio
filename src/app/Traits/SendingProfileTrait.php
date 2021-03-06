<?php

namespace TheCodealer\LaravelTwilio\Traits;

trait SendingProfileTrait {

    public function getTwiml() {
        return $this->twiml;
    }

    public function getOptions() {
        $options = [];

        if ($this->getTwiml()) {
            $options['twiml'] = $this->getTwiml();
        }

        if (ConfigTrait::getConfig('call_twiml_url')) {
            $options['url'] = ConfigTrait::getConfig('call_twiml_url');
        }

        // if (isset($this->recordCall)) {
        //     $options['record'] = $this->recordCall;
        // }

        if (isset($this->trackCallStatus) && $this->trackCallStatus) {
            $options['statusCallback'] = ConfigTrait::getConfig('call_status_callback_url') ? ConfigTrait::getConfig('call_status_callback_url') : route('thecodealerlaraveltwilio.callbacks.twilio.call-status');
            $options['statusCallbackMethod'] = 'GET';
            $options['statusCallbackEvent'] = ['initiated', 'ringing', 'answered', 'completed'];
        }

        return $options;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public static function getCallingProfile($name = null, $args = []) {
        return self::getProfile($name, 'call', $args);
    }

    private static function getProfile($name = null, $type = 'call', $args = []) {
        $type_name = $type . 'ing';
        if (!$name) {
            $name = ConfigTrait::getConfig("default_{$type_name}_profile");
        }
        $class = ConfigTrait::getConfig("{$type_name}_profiles." . $name);

        if (class_exists($class)) {
            return $profile = new $class($args);
        }
    }
}
