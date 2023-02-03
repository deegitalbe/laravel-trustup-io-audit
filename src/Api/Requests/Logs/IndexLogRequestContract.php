<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;

class IndexLog implements IndexLogRequestContract
{

    /**
     * @param Collection<int, string>
     * @return static
     */
    public function setUuids(Collection $uuids): IndexLogRequestContract
    {
        return $this;
    }
}
