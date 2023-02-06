<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Requests\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs\IndexLogRequestContract;

class IndexLogRequest implements IndexLogRequestContract
{
    /** @var Collection<int, string> */
    protected Collection $uuids;

    /**
     * @param Collection<int, string>
     * @return static
     */
    public function setUuids(Collection $uuids): IndexLogRequestContract
    {
        $this->uuids = $uuids;
        return $this;
    }

    /**
     * @return Collection<int, string>
     */
    public function getUuids(): Collection
    {
        return $this->uuids;
    }

    public function hasUuids(): bool
    {
        return $this->getUuids()->isNotEmpty();
    }
}
