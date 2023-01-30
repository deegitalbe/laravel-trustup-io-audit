<?php
namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Henrotaym\LaravelApiClient\Contracts\ResponseContract;

interface StoreLogResponseContract
{
    public function getResponse(): ResponseContract;

    public function setResponse(ResponseContract $response): StoreLogResponseContract;

    public function getUuid(): ?string;
}