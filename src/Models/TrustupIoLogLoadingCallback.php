<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Models;


use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs\LogEndpointContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoExternalModelRelations\Contracts\Models\Relations\ExternalModelRelationLoadingCallbackContract;

class TrustupIoLogLoadingCallback implements ExternalModelRelationLoadingCallbackContract
{
    /**
     * @var LogEndpointContract
     */
    protected LogEndpointContract $endpoint;

    public function __construct(LogEndpointContract $logEndpointContract, protected IndexLogRequestContract $indexLogRequestContract)
    {
        $this->endpoint = $logEndpointContract;
    }

    /** @return Collection<int, LogContract> */
    public function load(Collection $identifiers): Collection
    {
        $this->indexLogRequestContract->setUuids($identifiers);
        return $this->endpoint->index($this->indexLogRequestContract)->getLogs();
    }
}
