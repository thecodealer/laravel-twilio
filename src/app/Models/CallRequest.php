<?php

namespace TheCodealer\LaravelTwilio\Models;

use TheCodealer\LaravelTwilio\Traits\CallRequestTrait;

class CallRequest extends BaseModel {
    use CallRequestTrait;

    protected $table = TheCodealerLaravelTwilioTablePrefix . 'call_requests';
}