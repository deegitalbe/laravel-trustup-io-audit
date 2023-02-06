<?php

namespace Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs;

use Illuminate\Support\Collection;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Models\LogContract;
use Deegitalbe\LaravelTrustupIoAudit\Api\Responses\Logs\LogResponse;
use Deegitalbe\LaravelTrustupIoAudit\Contracts\Api\Responses\Logs\IndexLogResponseContract as LogsIndexLogResponseContract;

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
        if ($this->getResponse()->failed()) return collect();

        $body = $this->getResponse()->response()->get(true);
        
        return collect($body['data'])->map(
            fn (array $attributes) => $this->transformRawLog($attributes)
        );
    }

    protected function transformRawLog(array $attributes): LogContract
    {
        /** @var LogContract */
        $log = app()->make(LogContract::class);

        return $log->fromArray($attributes);
    }
}
