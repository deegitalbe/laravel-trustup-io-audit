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
        $formated = app()->make(StoreLogResponseContract::class);
        return $formated->setResponse($response);
    }

    public function index(IndexLogRequestContract $indexLogRequestContract): IndexLogResponseContract
    {
        // filter logs when previous specified identifiers.
        $this->request->setVerb("GET")->setUrl("logs");
        if ($indexLogRequestContract->hasUuids()) {
            $this->request->addQuery(['uuids' => $indexLogRequestContract->getUuids()->all()]);
        }
        $response = $this->client->try($this->request, "Cannot get logs");
        /** @var IndexLogResponseContract */
        $formated = app()->make(IndexLogResponseContract::class);
        return $formated->setResponse($response);
    }
}
