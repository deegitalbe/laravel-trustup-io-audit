<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CallLogEndpoint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected $endpoint, protected $request)
    {
        $this->endpoint = $endpoint;
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return $this->endpoint->store($this->request);
    }
}
