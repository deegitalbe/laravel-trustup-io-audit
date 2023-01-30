<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\ResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

class StoreLogResponse implements StoreLogResponseContract
{
    public string $uuid;
    public ResponseContract $response;

    public function getResponse(): ResponseContract
    {
        return $this->response;
    }

    public function setResponse(ResponseContract $response): StoreLogResponseContract
    {
        $this->response = $response;
        return $this;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }
}
