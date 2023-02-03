<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Henrotaym\LaravelApiClient\Contracts\ResponseContract;

interface StoreLogResponseContract extends LogResponseContract
{
    public function getUuid(): ?string;
}
