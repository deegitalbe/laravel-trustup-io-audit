<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\TrustupIoAuditRelatedModelContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Services\Logs\Adapters\LogServiceAdapterContract;

// this is the class used by your model observer.
interface LogServiceContract
{
    // based on config this class should be binded in your service provider
    // instanciated in constructor
    public function getAdapter(): LogServiceAdapterContract;

    // instanciated in constructor
    public function getEndpoint(): LogEndpointContract;

    // using endpoint
    public function store(TrustupIoAuditRelatedModelContract $model, string $eventName): StoreLogResponseContract;
}