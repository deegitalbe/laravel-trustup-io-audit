<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\LogContract;

interface IndexLogResponseContract extends LogResponseContract
{
    /**
     * @return Collection<int, LogContract>
     */
    public function getLogs(): Collection;
}
