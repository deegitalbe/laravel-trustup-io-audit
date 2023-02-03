<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\ResponseContract;

interface LogResponseContract
{
    public function getResponse(): ResponseContract;

    /** @return static */
    public function setResponse(ResponseContract $response): LogResponseContract;
}