<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\ResponseContract;

interface StoreLogResponseContract
{
    public function getResponse(): ResponseContract;

    public function setResponse(ResponseContract $response): StoreLogResponseContract;

    public function getUuid(): ?string;
}
