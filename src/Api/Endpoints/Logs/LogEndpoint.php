<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs;

use Carbon\Carbon;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Credentials\LogCredential;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

class LogEndpoint implements LogEndpointContract
{

    protected ClientContract $client;

    public function __construct(ClientContract $client, LogCredential $credential, protected RequestContract $request)
    {
        $this->client = $client->setCredential($credential);
        $this->request = $request;
    }

    public function store(StoreLogRequestContract $storeRequest): StoreLogResponseContract
    {

        $this->request->setVerb("POST")->setUrl("logs")->addData($storeRequest->toArray());
        $response = $this->client->try($this->request, "Cannot store log");
        /** @var StoreLogResponseContract */
        return app()->make(StoreLogResponseContract::class)->setResponse($response->response());
    }

    public function index(IndexLogRequestContract $request): IndexLogResponseContract
    {
        $this->request->setVerb("GET")->setUrl("logs");
        $response = $this->client->try($this->request, "Cannot get logs");
        /** @var IndexLogResponseContract */
        return app()->make(IndexLogResponseContract::class)->setResponse($response->response());
    }
}
