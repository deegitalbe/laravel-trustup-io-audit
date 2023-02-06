<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;

interface LogResponseContract
{
    public function getResponse(): TryResponseContract;

    /** @return static */
    public function setResponse(TryResponseContract $response): LogResponseContract;
}