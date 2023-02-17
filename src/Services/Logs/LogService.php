<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Services\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Jobs\CallLogEndpoint;
use Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs\StoreLogRequest;
use Deegitalbe\LaravelTrustupIoAudit\Services\Logs\Adapters\LogServiceAdapter;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogServiceContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\LogStatusContrat;

class LogService implements LogServiceContract
{
    public function __construct(protected LogServiceAdapterContract $adapter, protected  LogEndpointContract $endpoint)
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

    public function storeModel(string $eventName, TrustupIoAuditRelatedModelContract $model): ?string
    {
        /** @var StoreLogRequestContract */
        $request = app()->make(StoreLogRequestContract::class);
        $request->setEventName($eventName)
            ->setPayload($model->getTrustupIoAuditPayload())
            ->setModelId($model->getTrustupIoAuditModelId())
            ->setModelType($model->getTrustupIoAuditModelType())
            ->setResponsibleId($this->getAdapter()->getResponsibleId())
            ->setResponsibleType($this->getAdapter()->getResponsibleType())
            ->setAppKey($this->getAdapter()->getAppKey())
            ->setAccountUuid($this->getAdapter()->getAccountUuid())
            ->setLoggedAt()
            ->setImpersonatedBy($this->getAdapter()->getImpersonatedBy());
        return  $this->storeRequest($request);
    }


    public function storeAttributes(string $eventName, array $attributes): ?string
    {
        /** @var StoreLogRequestContract */
        $request = app()->make(StoreLogRequestContract::class);

        $request->setEventName($eventName)->setLoggedAt()->fromArray($attributes);
        return  $this->storeRequest($request);
    }

    // dispatch job that triggers endpoint.
    public function storeRequest(StoreLogRequestContract $request): ?string
    {   // set uuid on request before calling endpoint.
        /** @var LogStatusContrat */
        $logStatus = app()->make(LogStatusContrat::class);
        // IN UPDATED IS DISABLED IS FALSE ?????
        if ($logStatus->isDisabled()) return null;
        $uuid = $request->getUuid();
        CallLogEndpoint::dispatch($request);
        return $uuid;
    }
}
