<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogResponseContract;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Request;

class LogEndpoint implements LogEndpointContract
{
    public function __construct(protected ClientContract $client)
    {
    }

    public function store(StoreLogRequestContract $storeRequest): StoreLogResponseContract
    {
        dd($storeRequest);
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $storeRequest->toArray();


        // ... continue here

        return app()->make(StoreLogResponseContract::class);
    }
}
