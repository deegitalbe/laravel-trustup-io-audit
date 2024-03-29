<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Requests\Logs;

use Illuminate\Support\Collection;

interface IndexLogRequestContract
{
    /**
     * @param Collection<int, string>
     * @return static
     */
    public function setUuids(Collection $uuids): IndexLogRequestContract;

    /**
     * @return Collection<int, string>
     */
    public function getUuids(): Collection;

    /** @return bool */
    public function hasUuids(): bool;
}
