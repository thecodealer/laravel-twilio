<?php

namespace TheCodealer\LaravelTwilio\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use TheCodealer\LaravelTwilio\Models\CallRequest;

class RetryCallRequests extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call-requests:retry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry answered call requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $now = Carbon::now();
        $call_requests = CallRequest::where('status', 'retry')->where('retry_at', '<=', $now)->orderBy('retry_at', 'ASC')->get();
        if (!$call_requests->isEmpty()) {
            foreach ($call_requests as $call_request) {
                $call_request->process();
            }
        }
    }
}
