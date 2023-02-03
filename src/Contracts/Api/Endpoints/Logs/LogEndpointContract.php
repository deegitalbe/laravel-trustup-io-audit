<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Endpoints\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\StoreLogRequestContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

interface LogEndpointContract
{
    public function store(StoreLogRequestContract $request): StoreLogResponseContract;

    public function index(IndexLogRequestContract $request): IndexLogResponseContract;
}
