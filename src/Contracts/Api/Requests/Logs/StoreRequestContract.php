<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;

/**
 * Representing an index request on log endpoint.
 */
interface StoreRequestContract
{
    public function toArray(LogContract $log): array;
}
