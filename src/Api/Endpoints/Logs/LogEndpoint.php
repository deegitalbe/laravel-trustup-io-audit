<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Endpoints\Logs;

use Carbon\Carbon;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Credentials\LogCredential;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

class LogEndpoint implements LogEndpointContract
{

    protected $client;

    public function __construct(ClientContract $client, LogCredential $credential)
    {
        $this->client = $client->setCredential($credential);
    }

    public function store(StoreLogRequestContract $storeRequest): StoreLogResponseContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $request->setVerb("POST")->setUrl("logs")->addData($storeRequest->toArray());
        $response = $this->client->try($request, "Cannot store log");
        dd($response->failed(), $response->error()->context());
        /** @var StoreLogResponseContract */
        return app()->make(StoreLogResponseContract::class)->setResponse($response->response());
    }

    // /** Automatic log creation function */
    // public function triggerAuditLog(mixed $payload): self
    // {
    //     /** @var StoreLogRequest  */
    //     dd(auth()->user(), static::class);
    //     $logRequest = app()->make(StoreLogRequest::class);
    //     $logRequest->setResponsibleId(auth()->user()->id)->setResponsibleType(auth()->user()->roles[0])->setAppKey(env('APP_NAME'))->setModelId($payload->uuid)
    //         ->setModelType(static::class)->setPayload($payload->getAttributes())->setAccountUuid("temp")
    //         ->setEventName(Created::class)->setLoggedAt(Carbon::now())->setImpersonatedBy(auth()->user()->id);
    //     /** @var LogEndpointContract  */
    //     $endpoint = app()->make(LogEndpointContract::class);
    //     $endpoint->store($logRequest);
    //     return $this;
    // }
}
