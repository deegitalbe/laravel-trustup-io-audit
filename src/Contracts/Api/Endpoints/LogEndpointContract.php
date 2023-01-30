<?php

namespace Deegitalbe\LaravelTrustupIoProjects\Contracts\Api\Endpoints;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\LogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreResponseContract;
use Deegitalbe\LaravelTrustupIoProjects\Contracts\Api\Requests\Project\IndexRequestContract;
use Deegitalbe\LaravelTrustupIoProjects\Contracts\Api\Responses\Project\IndexResponseContract;

/**
 * Representing project endpoint.
 */
interface LogEndpointContract
{
    /**
     * Getting log.
     * 
     * @param IndexRequestContract $request
     * @return IndexResponseContract
     */
    public function store(LogContract $log): StoreResponseContract;
}
