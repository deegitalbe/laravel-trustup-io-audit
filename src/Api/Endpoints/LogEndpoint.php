<?php

namespace Deegitalbe\LaravelTrustupIoProjects\Api\Endpoints;

use Henrotaym\LaravelApiClient\Contracts\ClientContract;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Credentials\LogCredential;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreRequestContract;
use Deegitalbe\LaravelTrustupIoProjects\Contracts\Api\Endpoints\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreResponseContract;

class LogEndpoint implements LogEndpointContract
{

    protected ClientContract $client;

    public function __construct(ClientContract $client, LogCredential $credential)
    {

        $this->client = $client->setCredential($credential);
    }

    public function store(LogContract $log): StoreResponseContract
    {


        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $request->setVerb('POST')->setUrl('logs')->addData($storeRequest);

        $response = $this->client->try($request, "Cannot store log");

        /** @var StoreResponseContract */
        return app()->make(StoreResponseContract::class)->setResponse($response);
    }
}
