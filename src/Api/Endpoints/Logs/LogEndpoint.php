<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs;

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

    public function __construct(ClientContract $client, LogCredential $credential)
    {
        $this->client = $client->setCredential($credential);
    }

    public function store(StoreLogRequestContract $storeRequest): StoreLogResponseContract
    {
        $requets = $this->newRequest();
        $requets->setVerb("POST")->setUrl("logs")->addData($storeRequest->toArray());
        $response = $this->client->try($requets, "Cannot store log");
        /** @var StoreLogResponseContract */
        $formated = app()->make(StoreLogResponseContract::class);
        return $formated->setResponse($response);
    }

    public function index(IndexLogRequestContract $indexLogRequestContract): IndexLogResponseContract
    {
        $requets = $this->newRequest();
        // filter logs when previous specified identifiers.
        $requets->setVerb("GET")->setUrl("logs");
        if ($indexLogRequestContract->hasUuids()) {
            $requets->addQuery(['uuids' => $indexLogRequestContract->getUuids()->all()]);
        }
        $response = $this->client->try($requets, "Cannot get logs");
        /** @var IndexLogResponseContract */
        $formated = app()->make(IndexLogResponseContract::class);
        return $formated->setResponse($response);
    }

    protected function newRequest()
    {
        /** @var RequestContract */
        return app()->make(RequestContract::class);
    }
}
