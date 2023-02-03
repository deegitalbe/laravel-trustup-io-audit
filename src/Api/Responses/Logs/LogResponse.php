<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\LogResponseContract;
use Henrotaym\LaravelApiClient\Contracts\ResponseContract;

class LogResponse implements LogResponseContract
{
    /** @var ResponseContract */
    protected ResponseContract $response;

    public function getResponse(): ResponseContract
    {
        return $this->response;
    }

    public function setResponse(ResponseContract $response): LogResponseContract
    {
        $this->response = $response;
        return $this;
    }
}
