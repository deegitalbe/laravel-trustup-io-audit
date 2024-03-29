<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\StoreLogResponseContract;

class StoreLogResponse extends LogResponse implements StoreLogResponseContract
{
    protected string $uuid;

    public function getUuid(): ?string
    {   // TODO
        return $this->getResponse()->response()->get()->log_uuid;
    }
}
