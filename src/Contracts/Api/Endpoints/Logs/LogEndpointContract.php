<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogResponseContract;

interface LogEndpointContract
{
    public function store(StoreLogRequestContract $request): StoreLogResponseContract;
}
