<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\LogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract as LogsIndexLogResponseContract;
use Deegitalbe\LaravelTrustupIoAudit\Models\Log;

class IndexLogResponse extends LogResponse implements LogsIndexLogResponseContract
{
    /**
     * @return Collection<int, LogContract>
     */
    protected Collection $logs;

    /**
     * @return Collection<int, LogContract>
     */
    public function getLogs(): Collection
    {
        if ($this->getResponse()->response()->failed()) return collect();
        $array = $this->getResponse()->get(true);
        return collect($array['data'])->map(
            fn (array $attribute) =>
            /** @var Log */
            app()->make(Log::class)->fromArray($attribute)
        );
    }
}
