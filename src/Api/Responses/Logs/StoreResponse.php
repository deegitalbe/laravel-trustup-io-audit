<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreResponseContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;

class StoreResponse implements StoreResponseContract
{
    public TryResponseContract $response;

    public function setResponse(TryResponseContract $response): StoreResponseContract
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse(): TryResponseContract
    {
        return $this->response;
    }
}
