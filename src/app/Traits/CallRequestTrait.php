<?php

namespace TheCodealer\LaravelTwilio\Traits;

use TheCodealer\LaravelTwilio\Services\TwilioService;

trait CallRequestTrait {
    public function process($args = []) {
        $profile = isset($args['profile']) ? $args['profile'] : null;
        TwilioService::call($this, null, $profile);
    }
}
