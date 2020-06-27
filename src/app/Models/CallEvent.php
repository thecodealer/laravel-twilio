<?php

namespace TheCodealer\LaravelTwilio\Models;

class CallEvent extends BaseModel {
    protected $table = TheCodealerLaravelTwilioTablePrefix . 'call_events';
    public $timestamps = false;

    public function call() {
        return $this->belongsTo(Call::class, 'sid', 'sid');
    }
}