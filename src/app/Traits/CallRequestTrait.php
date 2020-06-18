<?php

namespace TheCodealer\LaravelTwilio\Traits;

use TheCodealer\LaravelTwilio\Services\TwilioService;

trait CallRequestTrait {
    public function process() {
        TwilioService::call($this);
    }
}
