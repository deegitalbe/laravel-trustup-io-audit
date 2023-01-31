<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

class LogService implements LogServiceContract
{
    /** @var  LogServiceAdapter*/
    protected LogServiceAdapter $adapter;

    /** @var  LogEndpointContract*/
    protected LogEndpointContract $endpoint;

    public function __construct(LogServiceAdapterContract $adapter, LogEndpointContract $endpoint)
    {
        $this->adapter = $adapter;
        $this->endpoint = $endpoint;
    }

    public function getAdapter(): LogServiceAdapterContract
    {
        return $this->adapter;
    }

    public function getEndpoint(): LogEndpointContract
    {
        return $this->endpoint;
    }

    // based on config this class should be binded in your service provider
    // instanciated in constructor

    // using storeRequest
    public function storeModel(string $eventName, TrustupIoAuditRelatedModelContract $model): ?string
    {
        /** @var StoreLogRequest */
        $request = app()->make(StoreLogRequest::class);
        $request->setEventName($eventName)
            ->setPayload($model->getTrustupIoAuditPayload())
            ->setModelId($model->getTrustupIoAuditModelId())
            ->setModelType($model->getTrustupIoAuditModelType())
            ->setResponsibleId($this->adapter->getResponsibleId())
            ->setResponsibleType($this->adapter->getResponsibleType())
            ->setAppKey($this->adapter->getAppKey())
            ->setAccountUuid($this->adapter->getAccountUuid())
            ->setImpersonatedBy($this->adapter->getImpersonatedBy());

        return  $this->storeRequest($request);
    }

    // using storeRequest
    public function storeAttributes(string $eventName, array $attributes): ?string
    {
        /** @var StoreLogRequest */
        $request = app()->make(StoreLogRequest::class);
        $request->setEventName($eventName)->fromArray($attributes);
        return  $this->storeRequest($request);
    }

    // dispatch job that triggers endpoint.
    public function storeRequest(StoreLogRequestContract $request): ?string
    {
        return $this->endpoint->store($request)->getUuid();
    }
}