<?php

namespace TheCodealer\LaravelTwilio\Models;

class Call extends BaseModel {
    protected $table = TheCodealerLaravelTwilioTablePrefix . 'calls';

    public function call_request() {
        return $this->belongsTo(CallRequest::class);
    }
}