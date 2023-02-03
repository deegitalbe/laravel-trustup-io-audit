<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;

class IndexLog implements IndexLogRequestContract
{
    /** @var Collection<int, string> */
    protected Collection $uuids;

    /**
     * @param Collection<int, string>
     * @return static
     */
    public function setUuids(Collection $uuids): IndexLogRequestContract
    {
        return $this;
    }

    /**
     * @return Collection<int, string>
     */
    public function getUuids(Collection $uuids): Collection
    {
        return $this->uuids;
    }
}
