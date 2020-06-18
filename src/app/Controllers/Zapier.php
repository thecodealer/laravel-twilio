<?php

namespace TheCodealer\LaravelTwilio\Controllers;

use Illuminate\Http\Request;

use TheCodealer\LaravelTwilio\Models\CallRequest;
use TheCodealer\LaravelTwilio\Traits\ConfigTrait as Config;

class Zapier extends Controller {
    public function lead(Request $request) {
        if ($request->input('token') == Config::getConfig('zapier_token') && $request->input('phone_number')) {
            $caller_id = '18199405229';
            /** TODO */
            /** logic to determine caller_id based on phone number */

            $call_request = new CallRequest;
            $call_request->number = $request->input('phone_number');
            $call_request->caller_id = $caller_id;
            $call_request->status = 'pending';
            $call_request->raw_request = json_encode($request->except('token'));
            $call_request->save();
        }
    }
}
