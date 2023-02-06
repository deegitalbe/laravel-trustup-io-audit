<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\LogResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;

class LogResponse implements LogResponseContract
{
    protected TryResponseContract $response;

    public function getResponse(): TryResponseContract
    {
        return $this->response;
    }

    public function setResponse(TryResponseContract $response): LogResponseContract
    {
        $this->response = $response;
        return $this;
    }
}
