<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;

interface StoreResponseContract
{
    public function setResponse(TryResponseContract $response): StoreResponseContract;

    public function getResponse(): TryResponseContract;
}
