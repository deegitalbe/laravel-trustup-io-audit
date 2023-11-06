<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Jobs;


use Error;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Deegitalbe\LaravelTrustupIoAudit\Factories\QueueConnectionFactories;
use Deegitalbe\LaravelTrustupIoAudit\Factories\QueueConnectionSyncFactory;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;

class CallLogEndpoint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected StoreLogRequestContract $request;

    public function __construct(StoreLogRequestContract  $request, )
    {   
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(LogEndpointContract $endpoint)
    {
        $response = $endpoint->store($this->request);
        if ($response->getResponse()->failed() ) throw $response->getResponse()->error();
        return $response;
    }
}
