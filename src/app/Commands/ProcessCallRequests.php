<?php

namespace TheCodealer\LaravelTwilio\Commands;

use Illuminate\Console\Command;

use TheCodealer\LaravelTwilio\Models\CallRequest;

class ProcessCallRequests extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call-requests:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process pending call requests';

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
        $call_requests = CallRequest::where('status', 'pending')->orderBy('created_at', 'ASC')->get();
        if ($call_requests) {
            foreach ($call_requests as $call_request) {
                $call_request->process();
            }
        }
    }
}
